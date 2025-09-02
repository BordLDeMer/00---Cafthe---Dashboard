<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PanierController extends Controller
{
    /**
     * Afficher le contenu du panier (alias pour index)
     */
    public function index()
    {
        return redirect()->route('panier.voir');
    }

    /**
     * Afficher le contenu du panier
     */
    public function voirPanier()
    {
        $panier = Session::get('panier', []);
        $total = 0;

        // Vérifier et corriger la structure du panier
        foreach ($panier as $id => $details) {
            // Vérifier si les clés existent et les corriger si nécessaire
            if (!isset($details['prix'])) {
                $produit = Produit::find($id);
                if ($produit) {
                    $panier[$id]['prix'] = $produit->prix_produit;
                    $panier[$id]['designation'] = $panier[$id]['designation'] ?? $produit->designation_produit;
                    $panier[$id]['image'] = $panier[$id]['image'] ?? $produit->image_produit;
                }
            }

            // Calculer le total seulement si les clés existent
            if (isset($details['prix']) && isset($details['quantite'])) {
                $total += $details['prix'] * $details['quantite'];
            }
        }

        // Sauvegarder le panier corrigé
        Session::put('panier', $panier);

        return view('panier.voir', compact('panier', 'total'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouterProduit(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $panier = Session::get('panier', []);

        $quantite = $request->input('quantite', 1);

        // Vérifier le stock disponible
        $quantiteExistante = isset($panier[$id]) ? $panier[$id]['quantite'] : 0;
        $nouvelleQuantite = $quantiteExistante + $quantite;

        if ($nouvelleQuantite > $produit->stock) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += $quantite;
        } else {
            $panier[$id] = [
                'designation' => $produit->designation_produit,
                'prix' => $produit->prix_produit,
                'quantite' => $quantite,
                'image' => $produit->image_produit
            ];
        }

        Session::put('panier', $panier);

        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }

    /**
     * Mettre à jour la quantité d'un produit dans le panier
     */
    public function mettreAJour(Request $request, $id)
    {
        $panier = Session::get('panier', []);

        if (isset($panier[$id])) {
            $nouvelleQuantite = $request->input('quantite', 1);

            // Vérifier le stock
            $produit = Produit::findOrFail($id);
            if ($nouvelleQuantite > $produit->stock) {
                return redirect()->route('panier.voir')->with('error', 'Stock insuffisant pour cette quantité.');
            }

            if ($nouvelleQuantite <= 0) {
                unset($panier[$id]);
            } else {
                $panier[$id]['quantite'] = $nouvelleQuantite;
            }

            Session::put('panier', $panier);
        }

        return redirect()->route('panier.voir')->with('success', 'Panier mis à jour !');
    }

    /**
     * Supprimer un produit du panier
     */
    public function supprimerProduit($id)
    {
        $panier = Session::get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            Session::put('panier', $panier);
        }

        return redirect()->route('panier.voir')->with('success', 'Produit supprimé du panier !');
    }

    /**
     * Diagnostiquer et nettoyer le panier
     */
    public function diagnostiquerPanier()
    {
        $panier = Session::get('panier', []);

        Log::info('Contenu actuel du panier:', $panier);

        // Nettoyer le panier et le reconstruire
        $panierNettoye = [];

        foreach ($panier as $id => $details) {
            $produit = Produit::find($id);

            if ($produit) {
                $panierNettoye[$id] = [
                    'designation' => $produit->designation_produit,
                    'prix' => $produit->prix_produit,
                    'quantite' => $details['quantite'] ?? 1,
                    'image' => $produit->image_produit
                ];
            }
        }

        Session::put('panier', $panierNettoye);

        return redirect()->route('panier.voir')->with('success', 'Panier nettoyé et reconstruit !');
    }

    /**
     * Vider complètement le panier
     */
    public function viderPanier()
    {
        Session::forget('panier');
        return redirect()->route('panier.voir')->with('success', 'Panier vidé !');
    }

    /**
     * Valider l'achat (votre méthode existante)
     */
    public function validerAchat(Request $request)
    {
        $panier = Session::get('panier', []);

        if (empty($panier)) {
            return redirect()->route('panier.voir')->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            foreach ($panier as $id => $details) {
                $produit = Produit::findOrFail($id);

                // Vérifier si le stock est suffisant
                if ($produit->stock < $details['quantite']) {
                    throw new \Exception("Le stock de {$produit->designation_produit} est insuffisant. Il ne reste que {$produit->stock} unités en stock.");
                }

                // Mettre à jour le stock
                $produit->stock -= $details['quantite'];
                $produit->ventes += $details['quantite'];
                $produit->date_vente = now();

                // Sauvegarder les modifications
                if (!$produit->save()) {
                    throw new \Exception("Erreur lors de la mise à jour du produit {$produit->designation_produit}.");
                }

                Log::info("Produit {$produit->designation_produit} mis à jour. Nouveau stock: {$produit->stock}");
            }

            // Vider le panier après validation
            Session::forget('panier');

            DB::commit();

            return redirect()->route('panier.voir')->with('success', 'Votre achat a été validé avec succès ! Les stocks ont été mis à jour.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la validation de l'achat: " . $e->getMessage());
            return redirect()->route('panier.voir')->with('error', $e->getMessage());
        }
    }
}

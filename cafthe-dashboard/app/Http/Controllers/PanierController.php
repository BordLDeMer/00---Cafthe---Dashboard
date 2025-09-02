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
     * Redirige vers la vue du panier.
     */
    public function index()
    {
        return redirect()->route('panier.voir');
    }

    /**
     * Affiche le contenu du panier.
     */
    public function voirPanier()
    {
        $panier = Session::get('panier', []);
        $total = 0;

        // Vérifier et corriger la structure du panier
        foreach ($panier as $id => $details) {
            if (!isset($details['prix_ttc'])) {
                $produit = Produit::find($id);
                if ($produit) {
                    $panier[$id] = [
                        'designation_produit' => $produit->designation_produit,
                        'prix_ttc' => $produit->prix_ttc, // corrigé: utiliser le bon champ prix_ttc
                        'quantite' => $details['quantite'] ?? 1,
                        'image' => $produit->image_produit,
                    ];
                }
            }
            // Calculer le total sur la valeur éventuellement corrigée
            $item = $panier[$id] ?? $details;
            if (isset($item['prix_ttc']) && isset($item['quantite'])) {
                $total += $item['prix_ttc'] * $item['quantite'];
            }
        }

        // Sauvegarder le panier corrigé
        Session::put('panier', $panier);
        return view('panier.voir', compact('panier', 'total'));
    }

    /**
     * Ajoute un produit au panier.
     */
    public function ajouterProduit(Request $request, $id)
    {
        // 1. Valider la requête
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        // 2. Récupérer le produit
        $produit = Produit::findOrFail($id);

        // 3. Récupérer le panier depuis la session
        $panier = Session::get('panier', []);

        // 4. Vérifier le stock
        $quantite = $request->input('quantite', 1);
        $quantiteExistante = $panier[$id]['quantite'] ?? 0;
        if ($quantiteExistante + $quantite > $produit->stock) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        // 5. Ajouter ou mettre à jour le produit dans le panier
        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += $quantite;
        } else {
            $panier[$id] = [
                'designation_produit' => $produit->designation_produit,
                'prix_ttc' => $produit->prix_ttc,
                'quantite' => $quantite,
                'image' => $produit->image_produit,
            ];
        }

        // 6. Sauvegarder le panier dans la session
        Session::put('panier', $panier);

        // 7. Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }


    /**
     * Met à jour la quantité d'un produit dans le panier.
     */
    public function mettreAJour(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $panier = Session::get('panier', []);

        if (!isset($panier[$id])) {
            return redirect()->route('panier.voir')->with('error', 'Produit non trouvé dans le panier.');
        }

        $nouvelleQuantite = (int)$request->input('quantite');
        $produit = Produit::findOrFail($id);

        if ($nouvelleQuantite > $produit->stock) {
            return redirect()->route('panier.voir')->with('error', 'Stock insuffisant pour cette quantité.');
        }

        if ($nouvelleQuantite <= 0) {
            unset($panier[$id]);
            Session::put('panier', $panier);
            Log::info("Produit {$id} retiré du panier.");
            return redirect()->route('panier.voir')->with('success', 'Produit retiré du panier.');
        }

        $panier[$id]['quantite'] = $nouvelleQuantite;
        Session::put('panier', $panier);
        Log::info("Quantité du produit {$id} mise à jour à {$nouvelleQuantite}.");

        return redirect()->route('panier.voir')->with('success', 'Quantité mise à jour !');
    }

    /**
     * Supprime un produit du panier.
     */
    public function supprimerProduit($id)
    {
        $panier = Session::get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            Session::put('panier', $panier);
            Log::info("Produit {$id} supprimé du panier.");
        }

        return redirect()->route('panier.voir')->with('success', 'Produit supprimé du panier !');
    }

    /**
     * Diagnostique et nettoie le panier.
     */
    public function diagnostiquerPanier()
    {
        $panier = Session::get('panier', []);
        Log::info('Contenu actuel du panier:', $panier);

        $panierNettoye = [];
        foreach ($panier as $id => $details) {
            $produit = Produit::find($id);
            if ($produit) {
                $panierNettoye[$id] = [
                    'designation_produit' => $produit->designation_produit,
                    'prix_ttc' => $produit->prix_ttc,
                    'quantite' => $details['quantite'] ?? 1,
                    'image' => $produit->image_produit,
                ];
            }
        }

        Session::put('panier', $panierNettoye);
        Log::info('Panier nettoyé et reconstruit.');

        return redirect()->route('panier.voir')->with('success', 'Panier nettoyé et reconstruit !');
    }

    /**
     * Vide complètement le panier.
     */
    public function viderPanier()
    {
        Session::forget('panier');
        Log::info('Panier vidé.');
        return redirect()->route('panier.voir')->with('success', 'Panier vidé !');
    }

    /**
     * Valide l'achat et met à jour les stocks.
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

                if ($produit->stock < $details['quantite']) {
                    throw new \Exception("Stock insuffisant pour {$produit->designation_produit}.");
                }

                $produit->stock -= $details['quantite'];
                $produit->ventes += $details['quantite'];
                $produit->date_vente = now();

                if (!$produit->save()) {
                    throw new \Exception("Erreur lors de la mise à jour du produit {$produit->designation_produit}.");
                }

                Log::info("Produit {$produit->designation_produit} mis à jour. Nouveau stock: {$produit->stock}");
            }

            Session::forget('panier');
            DB::commit();

            return redirect()->route('panier.voir')->with('success', 'Votre achat a été validé avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur lors de la validation de l'achat: " . $e->getMessage());
            return redirect()->route('panier.voir')->with('error', $e->getMessage());
        }
    }
}

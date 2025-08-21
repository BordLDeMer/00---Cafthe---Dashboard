<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['produit', 'titre']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['produit', 'titre']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="product-card">
    <div class="product-card-header">
        <h3 class="product-card-title"><?php echo e($titre ?? 'Produit'); ?></h3>
    </div>
    <div class="product-card-image">
        <?php if($produit && $produit->image): ?>
            <img src="<?php echo e(asset('images/' . $produit->image)); ?>" alt="<?php echo e($produit->nom ?? 'Image du produit'); ?>" class="img-fluid">
        <?php else: ?>
            <img src="<?php echo e(asset('images/coffee-8861674.png')); ?>" alt="Image par défaut" class="img-fluid">
        <?php endif; ?>
    </div>
    <div class="product-card-body">
        <p><?php echo e($produit->nom_prenom ?? 'Nom du produit'); ?></p>
    </div>
    <div class="product-card-footer">
        <span class="product-card-price"><?php echo e(number_format($produit->prix ?? 0, 2, ',', ' ')); ?> €</span>
        <button class="product-card-button">Ajouter</button>
    </div>
</div>
<?php /**PATH C:\Users\benjamin.bidou\00---Cafthe---Dashboard\cafthe-dashboard\resources\views/partials/product-card.blade.php ENDPATH**/ ?>
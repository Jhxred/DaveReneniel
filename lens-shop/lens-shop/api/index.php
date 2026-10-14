<?php
$title = 'Home';
require_once __DIR__ . '/../includes/header.php';

$products = get_products();

// simple filter by type (?type=DSLR)
$type = isset($_GET['type']) ? $_GET['type'] : 'All';
if ($type !== 'All') {
    $products = array_filter($products, function ($p) use ($type) {
        return $p['type'] === $type;
    });
}
?>

<header class="hero">
  <h1>Find Your Perfect Camera</h1>
  <p>DSLRs and mirrorless cameras for students, hobbyists and pro photographers.</p>
  <a href="#products" class="btn">Shop Now</a>
</header>

<section class="container" id="products">
  <h2>Our Cameras</h2>

  <div class="filters">
    <a href="/?type=All#products" class="<?= $type == 'All' ? 'active' : '' ?>">All</a>
    <a href="/?type=DSLR#products" class="<?= $type == 'DSLR' ? 'active' : '' ?>">DSLR</a>
    <a href="/?type=Mirrorless#products" class="<?= $type == 'Mirrorless' ? 'active' : '' ?>">Mirrorless</a>
  </div>

  <div class="grid">
    <?php foreach ($products as $p): ?>
      <div class="card">
        <div class="img-box">📷</div>
        <span class="tag"><?= htmlspecialchars($p['type']) ?></span>
        <h3><?= htmlspecialchars($p['name']) ?></h3>
        <p class="desc"><?= htmlspecialchars($p['desc']) ?></p>
        <p class="price"><?= money($p['price']) ?></p>
        <?php if ($p['stock'] > 0): ?>
          <button class="btn small" onclick="alert('<?= htmlspecialchars($p['name'], ENT_QUOTES) ?> added to cart!')">Add to Cart</button>
        <?php else: ?>
          <button class="btn small disabled" disabled>Out of Stock</button>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="about">
  <h2>Why LensHub?</h2>
  <div class="grid3">
    <div><h3>🚚 Free Shipping</h3><p>On all orders over $500.</p></div>
    <div><h3>🛡️ 1 Year Warranty</h3><p>Every camera is covered.</p></div>
    <div><h3>🔄 30 Day Returns</h3><p>Not happy? Send it back.</p></div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

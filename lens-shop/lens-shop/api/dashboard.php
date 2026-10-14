<?php
$title = 'Dashboard';
require_once __DIR__ . '/../includes/header.php';

$products = get_products();
$message = '';

// handle add product form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $type  = $_POST['type'] ?? 'DSLR';
    $price = (float) ($_POST['price'] ?? 0);
    $stock = (int) ($_POST['stock'] ?? 0);

    if ($name == '' || $price <= 0) {
        $message = 'error|Please enter a name and a valid price.';
    } else {
        $ids = array_column($products, 'id');
        $products[] = [
            'id'    => $ids ? max($ids) + 1 : 1,
            'name'  => $name,
            'brand' => $brand,
            'type'  => $type,
            'price' => $price,
            'stock' => $stock,
            'desc'  => 'New camera added from the dashboard.'
        ];
        if (save_products($products)) {
            $message = 'success|Product added!';
        } else {
            $message = 'error|Could not save (the server is read-only, e.g. on Vercel). Works locally!';
            array_pop($products);
        }
    }
}

// stats
$total_products = count($products);
$total_stock = array_sum(array_column($products, 'stock'));
$inventory_value = 0;
$low_stock = 0;
foreach ($products as $p) {
    $inventory_value += $p['price'] * $p['stock'];
    if ($p['stock'] < 5) $low_stock++;
}

// fake orders (no database yet)
$orders = [
    ['#1042', 'Maria Santos', 'Canon EOS R50', 679.00, 'Shipped'],
    ['#1041', 'John Reyes', 'Nikon D3500', 499.00, 'Pending'],
    ['#1040', 'Ana Cruz', 'Sony Alpha a7 III', 1799.00, 'Delivered'],
    ['#1039', 'Luis Garcia', 'Fujifilm X-T30 II', 899.00, 'Delivered'],
];
?>

<div class="container">
  <h1>Admin Dashboard</h1>

  <div class="stats">
    <div class="stat"><h3><?= $total_products ?></h3><p>Products</p></div>
    <div class="stat"><h3><?= $total_stock ?></h3><p>Units in Stock</p></div>
    <div class="stat"><h3><?= money($inventory_value) ?></h3><p>Inventory Value</p></div>
    <div class="stat warn"><h3><?= $low_stock ?></h3><p>Low Stock Items</p></div>
  </div>

  <?php if ($message): list($kind, $text) = explode('|', $message); ?>
    <div class="alert <?= $kind ?>"><?= htmlspecialchars($text) ?></div>
  <?php endif; ?>

  <h2>Products</h2>
  <table>
    <tr><th>ID</th><th>Name</th><th>Brand</th><th>Type</th><th>Price</th><th>Stock</th></tr>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= htmlspecialchars($p['brand']) ?></td>
        <td><?= htmlspecialchars($p['type']) ?></td>
        <td><?= money($p['price']) ?></td>
        <td class="<?= $p['stock'] < 5 ? 'low' : '' ?>"><?= $p['stock'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2>Add New Camera</h2>
  <form method="POST" class="add-form">
    <input type="text" name="name" placeholder="Camera name" required>
    <input type="text" name="brand" placeholder="Brand">
    <select name="type"><option>DSLR</option><option>Mirrorless</option></select>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock">
    <button class="btn small" type="submit">Add Product</button>
  </form>

  <h2>Recent Orders</h2>
  <table>
    <tr><th>Order</th><th>Customer</th><th>Item</th><th>Total</th><th>Status</th></tr>
    <?php foreach ($orders as $o): ?>
      <tr>
        <td><?= $o[0] ?></td><td><?= $o[1] ?></td><td><?= $o[2] ?></td>
        <td><?= money($o[3]) ?></td>
        <td><span class="status <?= strtolower($o[4]) ?>"><?= $o[4] ?></span></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

# LensHub - Camera Shop (PHP)

A simple e-commerce school project built with PHP. Sells DSLR and mirrorless cameras.

## Features
- Homepage with product grid and filter (DSLR / Mirrorless)
- Admin dashboard with stats, product table, add-product form, recent orders
- Products stored in `data/products.json` (no database)

## Run locally
Needs PHP installed. From the project root:
```
cp -r public/css api/css
cd api && php -S localhost:8000
```
Open http://localhost:8000/index.php and http://localhost:8000/dashboard.php

(The links in the navbar use Vercel-style URLs like `/dashboard`, so
local testing is easiest by typing the `.php` URLs directly.)

## Deploy
1. Push to GitHub
2. Import the repo on vercel.com (Framework preset: Other)
3. Deploy. Uses the `vercel-php` runtime (see vercel.json)

## Known limitations
- Vercel's filesystem is read-only, so "Add Product" only saves locally.
- No login, no real cart, no database (could add MySQL later).

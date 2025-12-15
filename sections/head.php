<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    if (isset($_SESSION["project_sistem_penerimaan_blt"]["name_page"])) {
      echo $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . " - ";
    }
    echo $name_website;
    ?>
  </title>
  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/feather-icons"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          colors: {
            primary: '#2563eb', // Blue 600
            secondary: '#1e40af', // Blue 800
          }
        }
      }
    }
  </script>

  <style>
    .hero-pattern {
      background-color: #ffffff;
      opacity: 0.8;
      background-image: radial-gradient(#2563eb 0.5px, transparent 0.5px), radial-gradient(#2563eb 0.5px, #ffffff 0.5px);
      background-size: 20px 20px;
      background-position: 0 0, 10px 10px;
    }
  </style>
</head>

<body class="font-sans text-gray-700 antialiased bg-gray-50 flex flex-col min-h-screen"></body>
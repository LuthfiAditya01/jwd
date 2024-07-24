  <?php
  include 'connection.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $nik = htmlspecialchars(trim($_POST["nik"]));
      $nama = htmlspecialchars(trim($_POST["nama"]));
      $harga = htmlspecialchars(trim($_POST["harga"]));
      $jumlah = htmlspecialchars(trim($_POST["jumlah"]));
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./uploads/" . $_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      // if ($check !== false) {
      //   echo "File is an image - " . $check["mime"] . ".";
      //   $uploadOk = 1;
      // } else {
      //   echo "File is not an image.";
      //   $uploadOk = 0;
      // }
    }

    // Check if any field is empty
    if (empty($nik) || empty($nama) || empty($harga) || empty($jumlah)) {
      die("Semua nilai harus diisi.");
    }

    // Check if NIK is more than 16 digits
    if (strlen($nik) > 16) {
      die("NIK tidak boleh lebih dari 16 digit.");
    }

    // Check if inputs are valid numbers
    if (!is_numeric($harga) || !is_numeric($jumlah)) {
      die("Harga dan Jumlah harus berupa nilai numerik.");
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO penjualan (namabarang, harga, jumlahbarang, nik, filepath) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
      // Bind parameters
      $stmt->bind_param("siiis", $nama, $harga, $jumlah, $nik, $target_file);

      // Execute the statement
      if ($stmt->execute()) {
        echo "Record inserted successfully.";
      } else {
        echo "Error: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
    } else {
      echo "Error: " . $conn->error;
    }
  }

  $conn->close();
  ?>




  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
  </head>

  <body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://jkt48.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="https://pbs.twimg.com/profile_images/1245356242043695104/cWvULJnD_400x400.jpg" class="h-8" alt="KIII Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">KIII Shop</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
          <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Insert</a>
            </li>
            <li>
              <a href="view.php" disabled class="disabled:cursor-not-allowed block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Table View</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <form action="index.php" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
      <div class="mb-5">
        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
        <input type="number" maxlength="16" id="nik" name="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="255" placeholder="Nomor Induk Kependudukan" required />
      </div>
      <div class="mb-5">
        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
        <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="255" placeholder="Sabun Cuci Piring" required />
      </div>
      <div class="mb-5">
        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Barang</label>
        <input type="number" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="11" placeholder="20000" required />
      </div>
      <div class="mb-5">
        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Barang</label>
        <input type="number" id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="11" placeholder="3" required />
      </div>
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
      <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" name="fileToUpload" id="fileToUpload" type="file">
      <br>
      <button type="submit" name="submit" disabled class="disabled:cursor-not-allowed text-white bg-blue-700 disabled:bg-blue-300 hover:bg-blue-800  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
      function checkForm() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input');
        const submitButton = form.querySelector('button[type="submit"]');

        const isValid = Array.from(inputs).every(input => input.value.trim() !== '');
        submitButton.disabled = !isValid;
      }

      window.onload = function() {
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
          input.addEventListener('input', checkForm);
        });

        checkForm(); // Initial check to set the correct state on page load
      };
    </script>
  </body>

  </html>
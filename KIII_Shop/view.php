<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penjualan</title>
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
                        <a href="index.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Insert</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Table View</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        1
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Silver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr> -->

                <?php
                $result = $conn->query("SELECT * FROM penjualan");

                $row_number = 1; // Initialize the row number counter

                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                        " . $row_number . "
                    </th>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                        " . $row['namabarang'] . "
                    </th>
                    <td class='px-6 py-4'>
                        " . $row['harga'] . "
                    </td>
                    <td class='px-6 py-4'>
                        " . $row['jumlahbarang'] . "
                    </td>
                    <td class='px-6 py-4'>
                    " . $row['total'] . "
                    </td>
                    <td class='px-6 py-4'>
                        <img src='" . $row['filepath'] . "' alt=''>
                    </td>
                    <td class='px-6 py-4'>
                        <a href='update.php?id=" . $row['id'] . "' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                        <a href='delete.php?id=" . $row['id'] . "' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Delete</a>
                    </td>
                </tr>";
                    $row_number++; // Increment the row number counter
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; <span id="year"></span> KIII Shop. Allright Reserved</p>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
        // Mendapatkan elemen dengan id 'year'
        const yearElement = document.getElementById('year');
        // Mendapatkan tahun saat ini
        const currentYear = new Date().getFullYear();
        // Mengatur teks elemen dengan id 'year' ke tahun saat ini
        yearElement.textContent = currentYear;
    </script>

</body>

</html>
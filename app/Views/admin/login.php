<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1e0f08] min-h-screen flex items-center justify-center">

<div class="bg-white p-10 rounded-2xl shadow-xl w-96">

  <h2 class="text-2xl font-semibold mb-6 text-center">
    Admin Login
  </h2>

  <form method="post" action="<?= base_url('admin/process-login') ?>">

    <input type="text" name="username"
      placeholder="Username"
      class="w-full border rounded-lg px-4 py-3 mb-4">

    <input type="password" name="password"
      placeholder="Password"
      class="w-full border rounded-lg px-4 py-3 mb-6">

    <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold">
      Login
    </button>

  </form>

</div>

</body>
</html>
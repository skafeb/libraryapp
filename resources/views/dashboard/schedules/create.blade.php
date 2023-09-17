@extends("dashboard._utils.layout")

@section("head")
<title>Create Schedule - Refinitiv FEB UNPAD</title>
@endsection

@section("body")
<div class="w-full flex justify-center">

<div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-3" action="{{ route('dashboard.schedules.store') }}" method="post">
        @csrf
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Dapatkan jadwal penggunaan database refinitiv</h5>
        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 text-sm">
            <li>Hari Sabtu dan Minggu perpustakaan tutup</li>
            <li>Hari Jum'at sesi 4 perpustakaan tutup</li>
            <li>Pada tanggal cuti bersama perpustakaan ditutup</li>
            <li>Pembuatan jadwal hanya bisa dibuat sekali seminggu</li>
        </ul>
        @include("dashboard._utils.flash")
        <div>
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih tanggal</label>
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
        </div>
        <div>
            <label for="session" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih sesi</label>
            <select id="session" name="session" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="08:00:00">Sesi 1 08:00-09:00 </option>
                <option value="09:00:00">Sesi 2 09:00-10:00 </option>
                <option value="10:00:00">Sesi 3 10:00-11:00 </option>
                <option value="11:00:00">Sesi 4 11:00-12:00 </option>
                <option value="13:00:00">Sesi 5 13:00-14:00 </option>
                <option value="14:00:00">Sesi 6 14:00-15:00 </option>
                <option value="15:00:00">Sesi 7 15:00-16:00 </option>
            </select>
        </div>
        <div>
            <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" name="with_friend" id="with_friend" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Apakah anda ingin membawa teman</span>
            </label>
        </div>
        <div class="mb-6" id="friend_name_input">
            <label for="friend_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama teman anda</label>
            <input type="text" id="friend_name" name="friend_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value='{{ old("friend_name") }}'>
            @error("friend_name")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6" id="friend_npm_input">
            <label for="friend_npm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NPM teman anda</label>
            <input type="text" id="friend_npm" name="friend_npm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value='{{ old("friend_npm") }}'>
            @error("friend_npm")
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftarkan jadwal</button>
    </form>
</div>

</div>

<script>
    friendNpmInput = document.getElementById("friend_npm_input");
    friendNameInput = document.getElementById("friend_name_input");
    withFriend = document.getElementById("with_friend");
    if(!withFriend.checked) {
        friendNpmInput.classList.add("hidden");
        friendNameInput.classList.add("hidden");
    } else {
        friendNpmInput.classList.remove("hidden");
        friendNameInput.classList.remove("hidden");
    }
    withFriend.addEventListener("change", e => {
        if(e.target.checked == true) {
            friendNpmInput.classList.remove("hidden");
            friendNameInput.classList.remove("hidden");
        } else {
            friendNpmInput.classList.add("hidden");
            friendNameInput.classList.add("hidden");
        }
    })
</script>
@endsection

<!-- Main Navbar -->
<nav x-data="{ open: false }" class="flex items-center w-full bg-white fixed">
  <div class="container mx-auto">
    <div class="relative flex items-center justify-between -mx-4">
      <!-- Here We Go -->
      <div class="max-w-full px-4 w-60">
          <div class="ml-4 group">
            <button class="flex justify-center w-full py-5 align-center ">
              <p class="mt-1.5 mr-1.5 font-bold transition ease-in-out duration-500 group-hover:text-blue-600 group-hover:scale-110 motion-reduce:transition-none motion-reduce:hover:transform-none ">HERE</p>
              <p class="text-2xl font-bold transition duration-500 ease-in-out group-hover:text-blue-600 group-hover:scale-110 motion-reduce:transition-none motion-reduce:hover:transform-none ">WE</p>
              <p class="mt-1.5 ml-1.5 font-bold transition ease-in-out duration-500 group-hover:text-blue-600 group-hover:scale-110 motion-reduce:transition-none motion-reduce:hover:transform-none ">GO</p>
              <div class="flex invisible ml-2 font-bold transition-all duration-500 ease-out opacity-0 group-hover:visible group-hover:translate-x-2 motion-reduce:transition-none motion-reduce:hover:transform-none group-hover:opacity-100">
                <p class="mt-1 text-xl text-blue-800">/</p>
                <p class="mt-1 text-xl text-blue-700">/</p>
                <p class="ml-3 mt-1.5">Home</p>
              </div>
            </button>
          </div>
        </div>
      <div class="flex items-center justify-between w-full px-4">
         <!-- Space -->
          <div>
          </div>
          <!-- Search Bar -->
          <div class="relative mb-3" data-te-input-wrapper-init>
              <input
                type="search"
                class="peer block min-h-[auto] mt-3 w-80 rounded border-6 bg-[#F6F6F6] text-white px-3 py-[0.32rem] outline-none leading-[1.6] transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-blue-600 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-black dark:placeholder:text-gray-300 dark:peer-focus:text-blue-600 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                id="exampleSearch2"
                placeholder="Type query" />
              <label
                for="search"
                class="pointer-events-none absolute mt-3 left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] border-none text-gray-500 transition-all duration-500 ease-out peer-focus:text-blue-600 peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-blue-600 peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-gray-400 dark:peer-focus:text-blue-600"
                >Search</label>
            </div>
          <!-- Right -->
          <!-- Create Activity Icon -->
          <div class="justify-end hidden pr-16 sm:flex lg:pr-0">
            <div class="relative mt-2.5 mr-8 h-7 group">
              <button href="javascript:void(0)" class="w-7 h-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-8 transition duration-500 ease-in-out w-7 h-7 group-hover:scale-125">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="invisible group-hover:scale-105 group-hover:visible group-hover:animate-[move_35s_linear_infinite] group-hover:stroke-blue-600" stroke-dasharray="50" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
              </button>
              <x-tooltip title="Create New Activity" class=""></x-tooltip>
            </div>
            <!-- Friend List Icon -->
            <div class="relative mt-2.5 mr-8 h-7 group ">
              <button href="javascript:void(0)" class="w-7 h-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-8 transition duration-500 ease-in-out w-7 h-7 group-hover:scale-125">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="invisible group-hover:scale-105 group-hover:visible group-hover:animate-[move_35s_linear_infinite] group-hover:stroke-blue-600" stroke-dasharray="50" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
              </button>
              <x-tooltip title="Friends List" class=""></x-tooltip>
            </div>
            <!-- Messages Icon -->
            <div class="relative mt-2.5 mr-8 h-7 group">
              <button href="javascript:void(0)" class="w-7 h-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-8 transition duration-500 ease-in-out w-7 h-7 group-hover:scale-125">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="invisible group-hover:scale-105 group-hover:visible group-hover:animate-[move_35s_linear_infinite] group-hover:stroke-blue-600" stroke-dasharray="50" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                </svg>
              </button>
              <x-tooltip title="Messages" class=""></x-tooltip>
            </div>
            <!-- Notification Icon -->
            <div class="relative mt-2.5 h-7 group">
              <button href="javascript:void(0)" celass="w-7 h-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-8 transition duration-500 ease-in-out w-7 h-7 group-hover:scale-125">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="invisible group-hover:scale-105 group-hover:visible group-hover:animate-[move_35s_linear_infinite] group-hover:stroke-blue-600" stroke-dasharray="50" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
              </button>
              <x-tooltip title="Notification" class=""></x-tooltip>
            </div>

            <!-- Profile Click -->
            <div
              x-data="{
                  open: false,
                  toggle() {
                      if (this.open) {
                          return this.close()
                      }

                      this.$refs.button.focus()

                      this.open = true
                  },
                  close(focusAfter) {
                      if (! this.open) return

                      this.open = false

                      focusAfter && focusAfter.focus()
                  }
              }"
              x-on:keydown.escape.prevent.stop="close($refs.button)"
              x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
              x-id="['dropdown-button']"
              class="relative"
          >
              <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')" type="button" class="group">
                <img src="https://i.imgur.com/2AqbsF0.jpg" class="object-none object-scale-down w-12 h-12  transition-all duration-500 ease-in-out rounded-full group-hover:ring-2 group-hover:ring-blue-600 group-hover:ring-offset-base-100 group-hover:ring-offset-2 peer-focus:scale-125">
              </button>
              <!-- Dropdown Menu -->
              <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;" class="absolute w-40 shadow-md right-4 mt-6">
                <ul tabindex="0" class="absolute right-4 dropdown-content z-[1] menu p-2 shadow rounded bg-white rounded-box w-64 divide-y divide-gray-200">
                  <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <div>
                      <img src="https://i.imgur.com/2AqbsF0.jpg" class="inline-block object-none object-scale-down w-12 h-12 rounded-full">
                      <span class="absolute text-black ml-3 mt-1">Yourname Surname</span>
                      <span class="absolute text-gray-400 ml-3 mt-6">Edit your Profile</span>
                    </div>
                  </a>
                <div>
                  <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="">Setting</span>
                  </a>
                </div>
                <div>
                  <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span class="text-red-500">Logout</span>
                  </a>
                </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</nav>

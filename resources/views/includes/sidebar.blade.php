<div class="flex h-screen overflow-hidden overflow-y-scroll scroll-container flex-col justify-between border-e bg-[var(--bg-color-active)]">
  <div class="px-4 py-6 w-[250px]">
    <div class="flex justify-center w-full">
      <a href="/">
        <img class="w-[120px]" src="{{asset('logo/logo-no-background.png')}}" alt="">
      </a>
    </div>

    <ul class="mt-6 space-y-1 text-white">  
      <li>
        <a href="{{route('chapters')}}" class="{{ Request::is('chapters*') ? 'bg-[var(--bg-color-non-active)] text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700" >
          Chapters
        </a>
      </li>

      <li>
        <a href="{{route('lessons')}}" class="{{ Request::is('lessons*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
          Lessons
        </a>
      </li>

      {{-- <li>
        <a href="{{route('list.exercises')}}" class="{{ Request::is('list-exercises*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm  px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700">
          list of exercises
        </a>
      </li> --}}

      <li>
        <a href="{{route('exercises')}}" class="{{ Request::is('all-exercises') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm  px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700">
          Exercises
        </a>
      </li>

      <li>
        <details class="group [&_summary::-webkit-details-marker]:hidden" {{ Request::is('exercises*') ? 'open' : '' }}>
          <summary
            class="flex cursor-pointer {{ Request::is('exercises*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} items-center justify-between rounded-sm px-4 py-2  hover:bg-gray-100 hover:text-gray-700">
            <span class="text-sm font-medium"> Exercises </span>
            <span class="transition duration-300 shrink-0 group-open:-rotate-180">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor" >
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </span>
          </summary>

          <ul class="px-4 mt-2 space-y-1 text-nowrap ">
            <li>
              <a href="{{ route('vocabulary.index') }}" class="{{ Request::is('exercises/vocabulary*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                1. Vocabulary
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            <li>
              <a href="{{route('questionWord.index')}}" class="{{ Request::is('exercises/question-word*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                2. Question word
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            <li>
              <a href="{{ route('video.index') }}" class="{{ Request::is('exercises/video*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                3. Video
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(video)</p>
              </a>
            </li>

            <li id="audioTranslation">
              <a href="{{route('audioTranslation.index')}}" class="{{ Request::is('exercises/audio-translation*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                4. Audio translation
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(translation)</p>
              </a>
            </li>

            <li id="questionImage">
              <a href="{{route('questionImage.index')}}" class="{{ Request::is('exercises/question-image*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                5. Question image
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            <li id="spelling">
              <a href="{{route('spelling.index')}}" class="{{ Request::is('exercises/spelling*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                6. Spelling
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            {{-- <li id="phonetics">
              <a href="{{route('phonetics.index')}}" class="{{ Request::is('exercises/phonetics*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                6. Phonetics
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(Phonetics)</p>
              </a>
            </li> --}}

            <li id="pronunciation">
              <a href="{{route('pronunciation.index')}}" class="{{ Request::is('exercises/pronunciation*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                7. Pronunciation
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            <li id="grammar">
              <a href="{{route('grammar.index')}}" class="{{ Request::is('exercises/grammar*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                8. Grammar
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(grammar)</p>
              </a>
            </li>

            <li id="testImage">
              <a href="{{route('testImage.index')}}" class="{{ Request::is('exercises/test-image*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                9. Test Audio Image
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>

            <li id="testWord">
              <a href="{{route('testWord.index')}}" class="{{ Request::is('exercises/test-word*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                10. Test(reworse of 3rd) 
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
              </a>
            </li>
            
            <li id="listening">
              <a href="{{route('listening.index')}}" class="{{ Request::is('exercises/listening*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
                11. Listening
                <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(listening)</p>
              </a>
            </li>

          </ul>
        </details>
      </li>

      <li>
        <a href="{{route('information.index')}}" class="{{ Request::is('information*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm  px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700">
          <div class="flex gap-[2px]">
            <i class='bx bx-info-circle'></i>
              <span class="font-normal ">informations</span>
          </div>
        </a>
      </li>

      <li>
      </li>
      <li>
        <a href="{{route('language.index')}}" class="{{ Request::is('languages*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
          Languages
        </a>
      </li>
      @if (auth()->user()->role == 1)
      <li>
        <a href="{{route('profile.edit')}}" class="{{ Request::is('accounts/profile') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
          Profile
        </a>
      </li>
      <li>
        <a href="{{route('admin.controll')}}" class="{{ Request::is('accounts/admin*') ? 'bg-[var(--bg-color-non-active)]  text-black' : '' }} block rounded-sm px-4 py-2 text-sm font-medium  hover:bg-gray-100 hover:text-gray-700">
          admins
        </a>
      </li>
      @endif
      {{-- <li>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
          <button
            type="submit"
            class="w-full rounded-sm px-4 py-2 text-sm font-medium  [text-align:_inherit] hover:bg-gray-100 hover:text-gray-700">
            Logout
          </button>
        </form>
      </li> --}}
    </ul>
  </div>
  <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 ">
    <div class="flex items-center gap-2 bg-[var(--bg-color-active)] p-2">
      <i class='bx bx-user-circle text-gray-200 text-[36px] rounded-full object-cover'></i>  
      <div>
        <p class="text-xs text-gray-200">
          <strong class="block font-medium ">{{auth()->user()->name}}</strong>
          <span> {{auth()->user()->email}} </span>
        </p>
      </div>
      <div class="flex-1 w-full flex justify-end">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">
            <i class='bx bx-log-out text-[var(--bg-color-active)] hover:text-white text-[26px] cursor-pointer hover:bg-gray-700 bg-gray-200 p-2 pr-3 rounded-md'></i>
          </button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<div class="flex h-screen overflow-hidden overflow-y-scroll flex-col justify-between border-e bg-[var(--bg-color-active)]">
    <div class="px-4 py-6 ">
      <span class="grid h-10 w-32 place-content-center rounded-lg bg-[var(--bg-color-non-active)] text-xs text-gray-600">
        Logo
      </span>
  
      <ul class="mt-6 space-y-1">  
        

        <li>
          <a href="{{route('chapters')}}" class="{{ Request::is('chapters*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700" >
            Chapters
          </a>
        </li>
  
        <li>
          <a href="{{route('lessons')}}" class="{{ Request::is('lessons*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
            Lessons
          </a>
        </li>

        <li>
          <a href="{{route('list.exercises')}}" class="{{ Request::is('list-exercises*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg  px-4 py-2 text-sm font-medium text-gray-700">
            list of exercises
          </a>
        </li>

        <li>
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary
              class="flex cursor-pointer {{ Request::is('exercises*') ? 'bg-[var(--bg-color-non-active)]' : '' }} items-center justify-between rounded-lg px-4 py-2 text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
              <span class="text-sm font-medium"> Exercises </span>
              <span class="transition duration-300 shrink-0 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor" >
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </span>
            </summary>
  
            <ul class="px-4 mt-2 space-y-1 text-nowrap">
              <li>
                <a href="{{ route('vocabulary.index') }}" class="{{ Request::is('exercises/vocabulary*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  1. Vocabulary
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>
  
              <li>
                <a href="{{ route('video.index') }}" class="{{ Request::is('exercises/video*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  2. Video
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(video)</p>
                </a>
              </li>

              <li>
                <a href="{{route('questionWord.index')}}" class="{{ Request::is('exercises/question-word*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  3. Question word
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>

              <li>
                <a href="{{route('audioTranslation.index')}}" class="{{ Request::is('exercises/audio-translation*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  4. Audio translation
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(translation)</p>
                </a>
              </li>

              <li>
                <a href="{{route('questionImage.index')}}" class="{{ Request::is('exercises/question-image*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  5. Question image
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>

              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  6. ----------Proiznosheniye
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(pronunciation)</p>
                </a>
              </li>

              <li>
                <a href="{{route('pronunciation.index')}}" class="{{ Request::is('exercises/pronunciation*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  7. Pronunciation
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>

              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  8.  ------------Grammar
                  <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(grammar)</p>
                </a>
              </li>

              <li>
                <a href="{{route('testImage.index')}}" class="{{ Request::is('exercises/test-image*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                 9. Test Audio Image
                 <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>

              <li>
                <a href="{{route('testWord.index')}}" class="{{ Request::is('exercises/test-word*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                 10. Test(Question word reworse) 
                 <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>
              <li>
                <a href="{{route('spelling.index')}}" class="{{ Request::is('exercises/spelling*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                 11. Spelling
                 <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(vocabulary)</p>
                </a>
              </li>
              <li>
                <a href="{{route('listening.index')}}" class="{{ Request::is('exercises/listening*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                 12. Audio
                 <p class="text-[12px] text-gray-300 -mt-2 ml-4 hover:text-gray-500">(listening)</p>
                </a>
              </li>
            </ul>
          </details>
        </li>
        <li>
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary
              class="{{ Request::is('admin-controll*') ? 'bg-[var(--bg-color-non-active)]' : '' }} flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="text-sm font-medium"> Account </span>
  
              <span class="transition duration-300 shrink-0 group-open:-rotate-180">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </span>
            </summary>
  
            <ul class="px-4 mt-2 space-y-1">
              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                  Details
                </a>
              </li>
              @if (auth()->user()->role == 1)
                <li>
                    <a href="{{route('admin.controll')}}" class="block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
                    admins
                    </a>
                </li>
              @endif
              <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                  <button
                    type="submit"
                    class="w-full rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] [text-align:_inherit] hover:bg-gray-100 hover:text-gray-700">
                    Logout
                  </button>
                </form>
              </li>
            </ul>
          </details>
        </li>
        <li>
          <a href="{{route('language.index')}}" class="{{ Request::is('languages*') ? 'bg-[var(--bg-color-non-active)]' : '' }} block rounded-lg px-4 py-2 text-sm font-medium text-[var(--text-color-active)] hover:bg-gray-100 hover:text-gray-700">
            Languages
          </a>
        </li>
      </ul>
    </div>
  
    <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
      <a href="#" class="flex items-center gap-2 bg-[var(--bg-color-active)] p-4 hover:bg-gray-50">
        <i class='bx bx-user-circle text-[40px] rounded-full object-cover'></i>  
        <div>
          <p class="text-xs">
            <strong class="block font-medium">{{auth()->user()->name}}</strong>
  
            <span> {{auth()->user()->email}} </span>
          </p>
        </div>
      </a>
    </div>
  </div>
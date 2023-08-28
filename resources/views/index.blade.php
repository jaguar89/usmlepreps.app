<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Usmle Materials</title>
    <meta name="description" content="Simple landind page" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

      @vite('resources/css/app.css')
    <script
      src="https://kit.fontawesome.com/57209162a2.js"
      crossorigin="anonymous"
    ></script>
    <!--Replace with your tailwind.css once created-->
    <link
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700"
      rel="stylesheet"
    />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
      .gradient {
        /* background: linear-gradient(90deg, #d53369 0%, #daae51 100%); */
        background: rgb(62, 121, 136);
        background: linear-gradient(
          90deg,
          rgba(62, 121, 136, 1) 0%,
          rgba(112, 240, 110, 1) 86%,
          rgba(66, 139, 154, 1) 100%
        );
      }
    </style>
  </head>
  <body
    class="leading-normal tracking-normal text-white gradient"
    style="font-family: 'Source Sans Pro', sans-serif"
  >
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
      <div
        class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2"
      >
        <div class="pl-4 flex items-center">
          <a
            class="toggleColour flex items-center text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
            href="{{url('/')}}"
          >
            <!--Icon from: http://www.potlabicons.com/ -->
            <!-- <svg
              class="h-8 fill-current inline"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512.005 512.005"
            >
              <rect
                fill="#2a2a31"
                x="16.539"
                y="425.626"
                width="479.767"
                height="50.502"
                transform="matrix(1,0,0,1,0,0)"
              />
              <path
                class="plane-take-off"
                d=" M 510.7 189.151 C 505.271 168.95 484.565 156.956 464.365 162.385 L 330.156 198.367 L 155.924 35.878 L 107.19 49.008 L 211.729 230.183 L 86.232 263.767 L 36.614 224.754 L 0 234.603 L 45.957 314.27 L 65.274 347.727 L 105.802 336.869 L 240.011 300.886 L 349.726 271.469 L 483.935 235.486 C 504.134 230.057 516.129 209.352 510.7 189.151 Z "
              />
            </svg> -->
            <svg
              class="h-8 fill-current inline"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
            >
              <path d="M0 0h24v24H0z" fill="none" />
              <path
                d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z"
              />
            </svg>

            Usmle Materials
          </a>
        </div>
        <div class="block lg:hidden pr-4">
          <button
            id="nav-toggle"
            class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
          >
            <svg
              class="fill-current h-6 w-6"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div
          class="w-full flex-grow lg:flex text-center items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
          id="nav-content"
        >
          <ul
            class="list-reset lg:flex justify-end flex-1 items-center text-center"
          >
            <li class="mr-3">
              <a
                class="inline-block py-2 px-4 text-black no-underline"
                href="#services"
                >Services</a
              >
            </li>
            <li class="mr-3">
              <a
                class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                href="#testimonials"
                >Testimonials</a
              >
            </li>
            <li class="mr-3">
              <a
                class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                href="#features"
                >Features</a
              >
            </li>
          </ul>
          <a href="{{route('register')}}"
            id="navAction"
            class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
          >
            Register
          </a>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>

    <!--Hero-->
    <div class="pt-24">
      <div
        class="container px-3 mx-auto flex flex-wrap flex-col lg:flex-row items-center justify-between"
      >
        <!--Left Col-->
        <div
          class="flex flex-col w-full lg:w-2/5 justify-center items-start text-center md:text-left"
        >
          <!-- Refined the subtitle to highlight task-based learning -->
          <p class="w-full text-2xl">
            A Task-Based Approach to Master Medical Exams.
          </p>
          <!-- Refined the title to emphasize the focus on various systems -->
          <h1 class="my-4 text-5xl font-bold leading-tight">
            Conquer Every Medical System and Ace Your Exams!
          </h1>
          <!-- Refined description to include focus on tasks, systems, and exam preparedness -->
          <p class="leading-normal text-xl mb-8">
            Our platform offers targeted tasks from different medical systems,
            carefully designed to prepare you for your exams. Complete these
            tasks and gain the confidence to succeed in the real-world medical
            examinations.
          </p>
          <!-- Kept the button text, feel free to change -->
          <a href="{{route('app')}}"
            class="mx-auto z-20 lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline hover:bg-gray-200"
          >
            Get Started!
          </a>
        </div>
        <!--Right Col-->
        <div class="w-full lg:w-3/5 py-6">
          <img
            class="w-full md:w-4/5 z-50 mx-auto"
            src="{{asset('img/undraw_online_test_re_kyfx.svg')}}"
          />
        </div>
      </div>
    </div>

    <div class="relative -mt-12 lg:-mt-24">
      <svg
        viewBox="0 0 1428 174"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
      >
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g
            transform="translate(-2.000000, 44.000000)"
            fill="#FFFFFF"
            fill-rule="nonzero"
          >
            <path
              d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
              opacity="0.100000001"
            ></path>
            <path
              d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
              opacity="0.100000001"
            ></path>
            <path
              d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
              id="Path-4"
              opacity="0.200000003"
            ></path>
          </g>
          <g
            transform="translate(-4.000000, 76.000000)"
            fill="#FFFFFF"
            fill-rule="nonzero"
          >
            <path
              d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
            ></path>
          </g>
        </g>
      </svg>
    </div>

    <!-- Services-->
    <section id="services" class="bg-white border-b py-8">
      <div class="container max-w-5xl mx-auto m-8">
        <h2
          class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800"
        >
          Services
        </h2>
        <div class="w-full mb-4">
          <div
            class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"
          ></div>
        </div>
        <div class="flex flex-wrap">
          <div class="w-5/6 sm:w-1/2 p-6">
            <!-- Changed the title to focus on real-world application -->
            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
              Real-World Medical Scenarios
            </h3>
            <!-- Updated the text to highlight the real-world medical scenarios that your tasks cover -->
            <p class="text-gray-600 mb-8">
              Our platform provides a range of tasks that mimic real-world
              medical scenarios. These practical tasks are designed to give you
              hands-on experience, bridging the gap between theoretical
              knowledge and real-world application.
              <br />
              <br />
            </p>
          </div>

          <div class="w-full sm:w-1/2 p-6 mt-6">
            <img
              class="w-5/6 sm:h-64 mx-auto"
              src="{{asset('img/undraw_learning_re_32qv.svg')}}"
              alt="Description of SVG"
            />
          </div>
        </div>
        <div class="flex flex-wrap flex-col-reverse sm:flex-row">
          <!-- Your HTML content -->
          <div class="w-full sm:w-1/2 p-6 mt-6">
            <img
              class="w-5/6 sm:h-64 mx-auto"
              src="{{asset('img/undraw_medicine_b-1-ol.svg')}}"
              alt="Description of SVG"
            />
          </div>
          <div class="w-full sm:w-1/2 p-6 mt-6">
            <div class="align-middle">
              <!-- Updated title to highlight the Analytics and Feedback feature -->
              <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                Analytics & Personalized Feedback
              </h3>
              <!-- Updated content to describe the benefit of analytics and personalized feedback -->
              <p class="text-gray-600 mb-8">
                Gain insights into your performance with our in-depth analytics.
                Understand your strengths and areas that require improvement.
                Receive personalized feedback to make your preparation more
                effective and targeted.
                <br />
                <br />
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--Testimonials-->
    <section id="testimonials" class="bg-white border-b py-8">
      <div class="container mx-auto flex flex-wrap pt-4 pb-12">
        <h2
          class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800"
        >
          Testimonials
        </h2>
        <div class="w-full mb-4">
          <div
            class="h-1 mx-auto gradient w-1/3 opacity-25 my-0 py-0 rounded-t"
          ></div>
        </div>
        <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
          <div
            class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
          >
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                xGETTING STARTED
              </p>
              <div class="w-full font-bold text-xl text-gray-800 px-6">
                Lorem ipsum dolor sit amet.
              </div>
              <p class="text-gray-800 text-base px-6 mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.
              </p>
            </a>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div class="flex items-center justify-start">
              <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/ntGEV5c9wJU?si=elj7s_A_s7w0MbCG"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
          <div
            class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
          >
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                xGETTING STARTED
              </p>
              <div class="w-full font-bold text-xl text-gray-800 px-6">
                Lorem ipsum dolor sit amet.
              </div>
              <p class="text-gray-800 text-base px-6 mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.
              </p>
            </a>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div class="flex items-center justify-start">
              <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/ntGEV5c9wJU?si=elj7s_A_s7w0MbCG"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
          <div
            class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
          >
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                xGETTING STARTED
              </p>
              <div class="w-full font-bold text-xl text-gray-800 px-6">
                Lorem ipsum dolor sit amet.
              </div>
              <p class="text-gray-800 text-base px-6 mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.
              </p>
            </a>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div class="flex items-center justify-start">
              <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/ntGEV5c9wJU?si=elj7s_A_s7w0MbCG"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
          <div
            class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
          >
            <a href="#" class="flex flex-wrap no-underline hover:no-underline">
              <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                xGETTING STARTED
              </p>
              <div class="w-full font-bold text-xl text-gray-800 px-6">
                Lorem ipsum dolor sit amet.
              </div>
              <p class="text-gray-800 text-base px-6 mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                at ipsum eu nunc commodo posuere et sit amet ligula.
              </p>
            </a>
          </div>
          <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
          >
            <div class="flex items-center justify-start">
              <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/ntGEV5c9wJU?si=elj7s_A_s7w0MbCG"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
        <div
          class="container flex flex-col md:flex-row space-x-1 justify-center"
        >
          <figure class="my-12 md:w-1/3">
            <blockquote
              class="bg-teal-600 dark:bg-black pl-14 pr-8 py-12 rounded-3xl relative"
            >
              <p
                class="text-xl text-left mt-2 text-white dark:text-slate-400 before:content-['\201C'] before:font-serif before:absolute before:top-0 before:left-0 before:text-9xl before:text-white before:opacity-25 before:transform before:translate-x-2 before:translate-y-2 after:content-['\201D'] after:font-serif after:absolute after:-bottom-20 after:right-0 after:text-9xl after:text-white after:opacity-25 after:transform after:-translate-x-2 after:-translate-y-2"
              >
                Acme has always been there for me. Their Explorer rocket arrived
                in a wooden crate as expected. Life-long customer! A++ shopping
                experience.
              </p>
            </blockquote>
            <figcaption
              class="italic text-xl sm:text-2xl text-right mt-2 text-slate-500 dark:text-slate-400"
            >
              &#8212;Wile E. Coyote, Genius
            </figcaption>
          </figure>
          <figure class="my-12 md:w-1/3">
            <blockquote
              class="bg-teal-600 dark:bg-black pl-14 pr-8 py-12 rounded-3xl relative"
            >
              <p
                class="text-xl text-left mt-2 text-white dark:text-slate-400 before:content-['\201C'] before:font-serif before:absolute before:top-0 before:left-0 before:text-9xl before:text-white before:opacity-25 before:transform before:translate-x-2 before:translate-y-2 after:content-['\201D'] after:font-serif after:absolute after:-bottom-20 after:right-0 after:text-9xl after:text-white after:opacity-25 after:transform after:-translate-x-2 after:-translate-y-2"
              >
                The Acme Adventurer Rocket has thwarted my Illudium Q-36
                Explosive Space Modulator on several occassions.
                <span class="italic">This makes me very, very angry!</span>
                Nevertheless, K-9 and I have awarded Acme the Martian contract
                for space exploration rockets based on Acme's quality and sturdy
                designs.
              </p>
            </blockquote>
            <figcaption
              class="italic text-xl sm:text-2xl text-right mt-2 text-slate-500 dark:text-slate-400"
            >
              &#8212;Marvin The Martian &amp; K-9
            </figcaption>
          </figure>
          <figure class="my-12 md:w-1/3">
            <blockquote
              class="bg-teal-600 dark:bg-black pl-14 pr-8 py-12 rounded-3xl relative"
            >
              <p
                class="text-xl text-left mt-2 text-white dark:text-slate-400 before:content-['\201C'] before:font-serif before:absolute before:top-0 before:left-0 before:text-9xl before:text-white before:opacity-25 before:transform before:translate-x-2 before:translate-y-2 after:content-['\201D'] after:font-serif after:absolute after:-bottom-20 after:right-0 after:text-9xl after:text-white after:opacity-25 after:transform after:-translate-x-2 after:-translate-y-2"
              >
                I knew I not only wanted &#8212;
                <span class="italic">I needed</span> &#8212; Acme's Infinity
                Rocket for my mission in space. Acme delivered in one day!
                Nothing says <q class="italic">Take me to your leader</q> like
                Acme's Infinity Rocket! 💯
              </p>
            </blockquote>
            <figcaption
              class="italic text-xl sm:text-2xl text-right mt-2 text-slate-500 dark:text-slate-400"
            >
              &#8212;Buzz Lightyear
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

    <!-- <section id="plans" class="bg-gray-100 py-8">
      <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
        <h2
          class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800"
        >
          Plans
        </h2>
        <div class="w-full mb-4">
          <div
            class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"
          ></div>
        </div>
        <div
          class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4"
        >
          <div
            class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4"
          >
            <div
              class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow"
            >
              <div class="p-8 text-3xl font-bold text-center border-b-4">
                Free
              </div>
              <ul class="w-full text-center text-sm">
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
              </ul>
            </div>
            <div
              class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
            >
              <div
                class="w-full pt-6 text-3xl text-gray-600 font-bold text-center"
              >
                £0
                <span class="text-base">for one user</span>
              </div>
              <div class="flex items-center justify-center">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
                >
                  Sign Up
                </button>
              </div>
            </div>
          </div>
          <div
            class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10"
          >
            <div
              class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow"
            >
              <div class="w-full p-8 text-3xl font-bold text-center">Basic</div>
              <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
              <ul class="w-full text-center text-base font-bold">
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
              </ul>
            </div>
            <div
              class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
            >
              <div class="w-full pt-6 text-4xl font-bold text-center">
                £x.99
                <span class="text-base">/ per user</span>
              </div>
              <div class="flex items-center justify-center">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
                >
                  Sign Up
                </button>
              </div>
            </div>
          </div>
          <div
            class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4"
          >
            <div
              class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow"
            >
              <div class="p-8 text-3xl font-bold text-center border-b-4">
                Pro
              </div>
              <ul class="w-full text-center text-sm">
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
              </ul>
            </div>
            <div
              class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
            >
              <div
                class="w-full pt-6 text-3xl text-gray-600 font-bold text-center"
              >
                £x.99
                <span class="text-base">/ per user</span>
              </div>
              <div class="flex items-center justify-center">
                <button
                  class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
                >
                  Sign Up
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!--Features-->
    <section
      id="features"
      class="flex flex-col space-y-10 mt-10 py-12 text-center px-10"
    >
      <div class="flex flex-col items-center w-1/2 mx-auto space-y-8">
        <p class="hidden text-xl text-center text-slate-700">Recent updates</p>
        <h1 class="text-primary text-5xl font-extrabold font-montserrat">
          Features
        </h1>
      </div>
      <!--cards-->
      <div
        class="flex flex-col space-y-8 lg:space-y-0 lg:flex-row lg:space-x-8 xl:px-24 items-center justify-between text-center text-slate-700"
      >
        <!--card one-->
        <div
          class="bg-white rounded-[50px] shadow-sm cursor-pointer max-w-[50%] p-10 lg:w-1/3 hover:shadow-[0_3px_47px_rgba(0,0,0,0.15)]"
        >
          <!-- Image Container -->
          <div class="">
            <img
              src="{{asset('img/blog-card-1.png')}}"
              alt="Progress Tracking"
              class="mx-auto"
            />
          </div>

          <!-- Title -->
          <h1 class="text-primary mt-8 text-xl font-extrabold font-montserrat">
            Track Your Progress
          </h1>

          <!-- Description -->
          <p class="py-6 lg:tracking-wide text-sm">
            Monitor your learning journey effortlessly. Our platform provides
            real-time analytics to help you understand your strengths and areas
            for improvement.
          </p>
        </div>
        <!--card two-->
        <div
          class="bg-white rounded-[50px] shadow-sm cursor-pointer max-w-[50%] p-10 lg:w-1/3 hover:shadow-[0_3px_47px_rgba(0,0,0,0.15)]"
        >
          <!-- Image Container -->
          <div class="">
            <img
              src="{{asset('img/blog-card-2.png')}}"
              alt="Browse Systems and Tasks"
              class="mx-auto"
            />
          </div>

          <!-- Title -->
          <h1 class="text-primary mt-8 text-xl font-extrabold font-montserrat">
            Explore Systems & Tasks
          </h1>

          <!-- Subtitle -->
          <h3 class="text-slate-300 tracking-wide text-lg">
            Comprehensive Coverage
          </h3>

          <!-- Description -->
          <p class="my-3 lg:tracking-wide text-sm">
            Gain full access to an extensive library of medical systems and
            tasks. Equip yourself with all you need for an in-depth
            understanding and superior exam preparation.
          </p>
        </div>
        <!-- card three-->
        <div
          class="bg-white rounded-[50px] shadow-sm cursor-pointer max-w-[50%] p-10 lg:w-1/3 hover:shadow-[0_3px_47px_rgba(0,0,0,0.15)]"
        >
          <!-- Image Container -->
          <div class="">
            <img
              src="{{asset('img/blog-card-3.png')}}"
              alt="Solve and Complete Tasks"
              class="mx-auto"
            />
          </div>

          <!-- Title -->
          <h1 class="text-primary mt-8 text-xl font-extrabold font-montserrat">
            Solve & Complete Tasks
          </h1>

          <!-- Description -->
          <p class="py-6 lg:tracking-wide text-sm">
            Dive into real-world simulations and comprehensive tasks tailored to
            your exam. Solve, complete, and level up your skills for a
            guaranteed exam success.
          </p>
        </div>
      </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
    <svg
      class="wave-top"
      viewBox="0 0 1439 147"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
    >
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
          <g class="wave" fill="#f8fafc">
            <path
              d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"
            ></path>
          </g>
          <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
            <g
              transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) "
            >
              <path
                d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                opacity="0.100000001"
              ></path>
              <path
                d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                opacity="0.100000001"
              ></path>
              <path
                d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                opacity="0.200000003"
              ></path>
            </g>
          </g>
        </g>
      </g>
    </svg>
    <section class="container mx-auto text-center py-6 mb-12">
      <!-- Updated Title -->
      <h2
        class="w-full my-2 text-5xl font-bold leading-tight text-center text-white"
      >
        Get Started Today!
      </h2>
      <!-- Divider -->
      <div class="w-full mb-4">
        <div
          class="h-1 mx-auto bg-white w-1/2 opacity-25 my-0 py-0 rounded-t"
        ></div>
      </div>
      <!-- Updated Subtitle -->
      <h3 class="my-4 text-3xl leading-tight">
        Unlock a Wealth of Free Medical Resources and Guidance.
      </h3>
      <!-- Updated Button -->
      <a href="{{route('register')}}"
        class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
      >
        Register
      </a>
    </section>

    <!--Contact-->
    <section
      id="contact"
      class="flex flex-col space-y-8 lg:flex-row-reverse lg:justify-between items-center p-8 lg:px-24 lg:py-16 mx-auto"
    >
      <div class="lg:w-1/2 p-8 sm:px-16 md:px-24 lg:p-0 lg:ml-10">
        <img
          src="{{asset('img/contact-header-img.png')}}"
          alt="Medical Education Support"
          class="object-contain h-full md:object-scale-down"
        />
      </div>
      <div class="space-y-4 lg:w-1/2 text-center lg:text-left">
        <p class="text-2xl tracking-wide">Let's Connect</p>
        <h1 class="text-3xl sm:text-6xl font-montserrat text-primary font-bold">
          Ready to Take the Next Step in Your Medical Career?
        </h1>
        <p class="sm:text-lg font-light tracking-wider">
          We're a dedicated team of doctors and specialists committed to helping
          you pass your medical exams. Our resources are designed by
          professionals and are entirely free, because we believe in empowering
          the next generation of healthcare leaders. Have questions? Reach out
          to us!
        </p>
        <button
          onclick="window.location.href='mailto:support@usmlematerials.com'"
          class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline hover:bg-gray-200"
        >
          Contact Us
        </button>
      </div>
    </section>

    <!--Footer-->
    <footer
      class="relative bg-white text-gray-900 flex flex-col items-center space-y-12 py-10 px-24 mt-6"
    >
      <div
        class="flex flex-col text-left justify-center space-y-10 lg:flex-row lg:space-x-4"
      >
        <div class="flex flex-col space-y-10 lg:w-[22%] mt-6">
          <a
            class="no-underline flex items-center hover:no-underline font-bold text-2xl"
            href="#"
          >
            <svg
              class="h-8 fill-current inline"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
            >
              <path d="M0 0h24v24H0z" fill="none" />
              <path
                d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z"
              />
            </svg>
            Usmle Materials
          </a>
        </div>
        <div class="flex flex-col space-y-10 lg:w-[22%]">
          <h3 class="text-3xl font-bold">About</h3>
          <p class="text-sm tracking-wide pr-16">
            Usmle Materials is a collective effort of medical professionals
            committed to shaping the future of healthcare. We offer invaluable
            resources to help medical students pass their three-step exams and
            launch their careers. All our content is curated by experts and
            available for free, because we believe in empowering tomorrow's
            healthcare leaders.
          </p>
        </div>
        <div class="relative flex flex-col space-y-8 lg:w-[22%]">
          <h3 class="text-3xl font-bold">Contact Us</h3>
          <ul class="text-sm tracking-widest flex flex-col space-y-4">
            <!-- <li>
              <i class="fas fa-map-marker-alt text-blue-300 mr-2"></i>
              123 Business Centre<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;London SW1A
              1AA
            </li>
            <li>
              <i class="fas fa-phone-alt text-blue-300 mr-2"></i> 0123456789
            </li> -->
            <li>
              <i class="fas fa-envelope text-blue-300 mr-2"></i>
              support@usmlematerials.com
            </li>
          </ul>
        </div>
        <div class="flex flex-col justify-start space-y-8 lg:w-[22%]">
          <h3 class="text-3xl font-bold">Socials</h3>
          <div class="text-3xl flex flex-row space-x-6">
            <a href="#top" class=""><i class="fa fa-twitter"></i></a>
            <a href="#top" class=""><i class="fa fa-instagram"></i></a>
            <a href="#top" class=""><i class="fa fa-facebook"></i></a>
            <a href="#top" class=""><i class="fa fa-linkedin"></i></a>
          </div>
        </div>
      </div>
      <div class="">
        <p>
          © 2023
          <a
            href="#"
            target="_blank"
            title="Sakkour"
            class="hover:underline hover:text-white"
            >Usmle Materials</a
          >. All Rights Reserved.
        </p>
      </div>
      <div class="absolute bottom-0 right-[-10%]">
        <img src="img/footer-section-bg.png" alt="" />
      </div>
    </footer>

    <!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->
    <script>
      var scrollpos = window.scrollY;
      var header = document.getElementById("header");
      var navcontent = document.getElementById("nav-content");
      var navaction = document.getElementById("navAction");
      var brandname = document.getElementById("brandname");
      var toToggle = document.querySelectorAll(".toggleColour");

      document.addEventListener("scroll", function () {
        /*Apply classes for slide in bar*/
        scrollpos = window.scrollY;

        if (scrollpos > 10) {
          header.classList.add("bg-white");
          navaction.classList.remove("bg-white");
          navaction.classList.add("gradient");
          navaction.classList.remove("text-gray-800");
          navaction.classList.add("text-white");
          //Use to switch toggleColour colours
          for (var i = 0; i < toToggle.length; i++) {
            toToggle[i].classList.add("text-gray-800");
            toToggle[i].classList.remove("text-white");
          }
          header.classList.add("shadow");
          navcontent.classList.remove("bg-gray-100");
          navcontent.classList.add("bg-white");
        } else {
          header.classList.remove("bg-white");
          navaction.classList.remove("gradient");
          navaction.classList.add("bg-white");
          navaction.classList.remove("text-white");
          navaction.classList.add("text-gray-800");
          //Use to switch toggleColour colours
          for (var i = 0; i < toToggle.length; i++) {
            toToggle[i].classList.add("text-white");
            toToggle[i].classList.remove("text-gray-800");
          }

          header.classList.remove("shadow");
          navcontent.classList.remove("bg-white");
          navcontent.classList.add("bg-gray-100");
        }
      });
    </script>
    <script>
      /*Toggle dropdown list*/
      /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

      var navMenuDiv = document.getElementById("nav-content");
      var navMenu = document.getElementById("nav-toggle");

      document.onclick = check;
      function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
          // click NOT on the menu
          if (checkParent(target, navMenu)) {
            // click on the link
            if (navMenuDiv.classList.contains("hidden")) {
              navMenuDiv.classList.remove("hidden");
            } else {
              navMenuDiv.classList.add("hidden");
            }
          } else {
            // click both outside link and outside menu, hide menu
            navMenuDiv.classList.add("hidden");
          }
        }
      }
      function checkParent(t, elm) {
        while (t.parentNode) {
          if (t == elm) {
            return true;
          }
          t = t.parentNode;
        }
        return false;
      }
    </script>
  </body>
</html>

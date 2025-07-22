

<template>
  <div class="relative w-lg">
    <input
      type="text"
      placeholder="Suche nach etwas..."
      class="rounded-lg bg-(--clr-white) h-12 w-full placeholder-(--clr-black) p-(--app-padding) overflow-hidden"
    />
    <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-(--clr-brightgreen-300) rounded-r-md text-(--clr-darkgreen-500) py-3 px-4 h-full flex items-center w-content">
      <img src="/resources/assets/icons/icon-search.svg" alt="Search" class="w-5 mr-5"/>
       Suchen
    </button>
  </div>
</template>

<template>
  <section>
    <div class="px-5" style="margin-top: -130px">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mt-3">
          <div id="cartWrapper">
            <cart />

          </div>
        </div>

        <div class="col-xl-8 order-xl-1">
          <meals-list />
          <meals-single />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
};
</script>


<style scoped>
#cartWrapper {
  position: -webkit-sticky;
  position: sticky;
  top: 90px;
}
@media (min-width: 1024px) and (max-height: 657px) {
  #cartWrapper {
    overflow-y: auto;
    max-height: 800px;
  }
  #cartWrapper::-webkit-scrollbar {
    display: none;
  }

  /* Hide scrollbar for IE, Edge and Firefox */
  #cartWrapper {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
  }
}
</style>

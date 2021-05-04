<template>
  <form
    class="navbar-form d-flex flex-column justify-content-end"
    id="search-form"
  >
    <div class="input-group no-border">
      <input
        type="text"
        v-model="query"
        @input="search"
        class="form-control px-1"
        placeholder="Search..."
      />
      <button type="button" class="btn btn-white btn-round btn-just-icon">
        <i class="fa fa-spinner fa-spin" v-if="loading"></i>
        <i class="material-icons" v-else>search</i>
        <div class="ripple-container"></div>
      </button>
    </div>
    <div
      class="dropdown w-100 has-cool-scrollbar"
      v-if="resultsNotEmpty && query.length && !closed"
    >
      <div v-for="(value, key) in results" :key="key">
        <h6 class="px-2 py-3 bg-grey">{{ key }}</h6>
        <router-link
          style="color: inherit"
          v-for="item in value"
          :key="item.searchable.id"
          :to="getNewUrl(key ,item.url)"
        >
          <div class="w-100 px-2 py-3" @click="closed = true">
            {{ item.title }}
          </div>
        </router-link>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      results: {},
      query: "",
      loading: false,
      closed: true,
    };
  },
  computed: {
    resultsNotEmpty() {
      return Object.keys(this.results).length;
    },
  },
  methods: {
    getNewUrl(type , url) {
      const end = type != "orders" ? "/edit" : "/";
      return "/admin" + url + end;
    },
    search: _.debounce(function () {
      if (this.query.length < 2) {
        return;
      }
      this.closed = false;
      this.loading = true;
      axios
        .get("/api/dashboard/search", { params: { query: this.query } })
        .then((res) => {
          this.results = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => {
          this.loading = false;
        });
    }, 500),
  },
};
</script>

<style scoped>
.dropdown {
  position: absolute;
  top: 35px;
  left: 0;
  border: 1px solid rgb(230, 228, 228);
  border-radius: 5px;
  background-color: white;
  z-index: 10000;
  box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 20%),
    0 1px 5px 0 rgb(0 0 0 / 12%);
  max-height: 500px;
  overflow: auto;
}
#search-form {
  position: relative;
  min-width: 300px !important;
}
</style>
<template>
  <div class="modal fade" id="privacy-policy-modal" tabindex="-1" data-backdrop="static" role="dialog"
       aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Privacy policy</h5>
        </div>
        <div id="js-privacy-policy-modal-body" class="modal-body" v-html="content"></div>
        <div class="modal-footer">
          <button
              @click="setCookie"
              type="button"
              class="btn btn-primary btn-block"
              data-dismiss="modal"
          >OK
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import utilities from "./../utilities/cookies";

export default {
  data() {
    return {
      endpoint: "/privacy-policy/content",
      modal: "#privacy-policy-modal",
      cookieName: "__privacy",
      content: '',
    };
  },

  mounted() {
    this.setContentPlaceholder();
    this.load();
  },

  methods: {
    load() {
      let isPrivacyPage = this.isPrivacyPage();
      let isCookie = this.isCookie();

      if (!isPrivacyPage && !isCookie) {
        $(`${this.modal}`).modal("show");

        axios
            .get(this.endpoint)
            .then(({data}) => (this.content = data))
            .catch(error => console.log(error));
      }
    },

    setCookie() {
      let cookie = {
        name: this.cookieName,
        value: true,
        age: 30,
        domain: window.app.cookieDomain,
        path: "/"
      };

      let days = cookie.age;
      let length = days * 24 * 60 * 60;

      document.cookie = `${cookie.name}=${cookie.value}; max-age=${length}; domain=${cookie.domain}; path=${cookie.path}`;
    },

    setContentPlaceholder() {
      for (let i = 0; i < 10; i++) {
        this.content += "<div class='jumbotron'></div>";
      }
    },

    isPrivacyPage() {
      return window.location.href.includes("privacy-policy");
    },

    isCookie() {
      let cookieName = this.cookieName;
      return utilities.getCookie(cookieName);
    }
  }
};
</script>
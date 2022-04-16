var ed_al_desc_content;
var error = "";
var app = new Vue({
  el: "#modal ",
  data: {
    members: [],
    searchData: {
      mb_hp: "",
      mb_name: "",
    },
    branchMemberData: {
      memId: "",
      grade: "",
      etc: "",
    },
    errorMsg: "",
    successMsg: "",
    branch_id: $("#branch_id").val(),
    memberToModify: "",
  },

  mounted: function () {},
  methods: {
    successToast() {
      this.$snotify.success(app.successMsg, {
        position: "centerBottom",
      });
    },
    failToast() {
      this.$snotify.error(app.errorMsg, {
        position: "centerBottom",
      });
    },

    gradeChange(event) {
      app.branchMemberData.grade = event.target.value;
    },

    onChangeEtc(event) {
      app.branchMemberData.etc = event.target.value;
    },

    selectMember(member) {
      console.log(member);
      app.memberToModify = member.mb_no;
      app.branchMemberData.grade = member.grade;
      app.branchMemberData.etc = member.etc;
      app.branchMemberData.memId = member.mb_id;
    },

    searchMembers() {
      axios
        .get(
          `${vue_url}/vue.branch.php?action=read&mb_hp=${app.searchData.mb_hp}&mb_name=${app.searchData.mb_name}&branch_id=${app.branch_id}`
        )
        .then(function (response) {
          if (response.data.error) {
            app.errorMsg = response.data.message;
            app.failToast();
          } else {
            app.members = response.data.members;
            app.memberToModify = "";
            console.log(response.data);
          }
        });
    },

    addBranchMembe() {
      let formdata = new FormData();
      formdata.append("mb_id", app.branchMemberData.memId);
      formdata.append("grade", app.branchMemberData.grade);
      formdata.append("etc", app.branchMemberData.etc);
      formdata.append("branch_id", app.branch_id);

      axios
        .post(`${vue_url}/vue.branch.php?action=create`, formdata, {})
        .then(function (response) {
          if (response.data.error) {
            app.errorMsg = response.data.message;
            app.failToast();
          } else {
            app.successMsg = response.data.message;
            app.successToast();
            app.searchMembers();
          }
        });
    },

    updateBranchMember(id) {
      let formdata = new FormData();
      formdata.append("grade", app.branchMemberData.grade);
      formdata.append("etc", app.branchMemberData.etc);
      formdata.append("id", id);
      axios
        .post(`${vue_url}/vue.branch.php?action=update`, formdata, {})
        .then(function (response) {
          if (response.data.error) {
            app.errorMsg = response.data.message;
            app.failToast();
          } else {
            app.successMsg = response.data.message;
            app.successToast();
            app.searchMembers();
          }
          console.log(response.data);
        });
    },

    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    },
    clearMsg() {
      app.errorMsg = "";
      app.successMsg = "";
    },
  },
});

Vue.config.devtools = true;

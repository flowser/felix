

<script>
export default {
  methods: {
    $authcheck() {
      return this.$store.getters.Auth;
    },
    $authuser() {
      return this.$store.getters.AuthUser;
    },
    $authinstitution() {
      return this.$store.getters.AuthInstitution;
    },
    $authinstitutionid() {
      return this.$store.getters.AuthInstitutionId;
    },
    $authdepartment() {
      return this.$store.getters.AuthDepartment;
    },
    $authparams() {
      return this.$store.getters.AuthParams;
    },
    $authdepartmentid() {
      return this.$store.getters.AuthDepartmentId;
    },
    $authid() {
      return this.$store.getters.AuthUserId;
    },
    $authurl() {
      return this.$store.getters.AuthUrl;
    },
    $authurldept() {
      return this.$store.getters.AuthUrlDept;
    },
    $authurlclassmastdept() {
      return this.$store.getters.AuthUrlClassmastDept;
    },
    $authurllectdept() {
      return this.$store.getters.AuthUrlLectDept;
    },
    $authmembership() {
      return this.$store.getters.AuthMembership;
    },
  }
};
</script>



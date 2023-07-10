
<script>
export default {
  methods: {
    $hasrole(roleName) {
      let Roles = this.$store.getters.AuthUserRoles;
      if (Array.isArray(roleName) == true) {
        return roleName.some(ele => Roles.includes(ele));
      } else {
        return Roles.indexOf(roleName) !== -1;
      }
    },
    $can(permissionName) {
      let Permissions = this.$store.getters.AuthUserPermissions;
      if (Array.isArray(permissionName) == true) {
        return permissionName.some(ele => Permissions.includes(ele));
      } else {
        return Permissions.indexOf(permissionName) !== -1;
      }
    },
    $dashroute(){
         var acronym = this.$acronym();
         return acronym +' ' + 'Dashboard' ;
    },
    $dashboard(){
        if(this.$authcheck()){
            if(this.$hasrole('Superadmin','Admin')){
               return this.$store.getters.AuthDashboard;
            }
        }
    },
    $redirect(route){
        this.$route.meta.redirect = route;
        return console.log('2', route);
    }
  }
};
</script>




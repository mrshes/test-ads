export const actions = {
  login(context, data){
    return this.$auth.loginWith('local', {data})
  },

  logout(context, data){
    return this.$auth.logout();
  },

  register(context, data){
    return this.$axios.post('api/register', data);
  }

}

export const actions = {
  index(context,params = {}){
    return this.$axios.$get('/api/ads', {params})
  },

  store(context, formData){
    return this.$axios.$post('/api/ads', formData)
  }
}

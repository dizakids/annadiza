export const state = () => ({
  tags: null
})

export const getters = {
  tags: (state) => state.tags
}


export const mutations = {
  setTags (state, tags) {
    state.tags = tags
  }
}

export const actions = {
  async fetchTag({commit}) {
    let {data} = await this.$axios.$get('/tags');
    commit('setTags', data)
  }
}

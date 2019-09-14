export const state = () => ({
  prefs: {
    "1": "Киев",
    "2": "Днепр",
    "3": "Кривой Рог",
    "4": "Черновцы",
    "5": "Львов",
  }
})

export const getters = {
  prefs(state){
    return state.prefs;
  }
}

export default function({ route, redirect, store }) {
  store.dispatch('tags/fetchTag')
}
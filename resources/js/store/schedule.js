const state = {
  title:"",
  go_date:"",
  return_date:"",
}

const mutations = {
    setSchedule: (state, { title, go_date,return_date }) => {
    state.title=title,
    state.go_date=go_date
    state.return_date=return_date
  }
}


 
export default {
  namespaced:true,
  state,
  mutations,
}
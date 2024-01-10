const context = require.context('./', true, /\.vue$/i)
export default context.keys().reduce((c, v) => {
  let result = {
    ...c
  }
  if (context(v).default.name) {
    result[context(v).default.name] = { ...context(v).default }
  }
  return result
}, {})

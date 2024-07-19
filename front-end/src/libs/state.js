import { getCurrentInstance } from "vue";

export function useGlobalState() {
    const { appContext } = getCurrentInstance();
      
    const globalState = appContext.config.globalProperties.$globalState;
  
    return {
      loggedIn: globalState.loggedIn,
      setLoggedIn: appContext.config.globalProperties.setLoggedIn
    };
  }
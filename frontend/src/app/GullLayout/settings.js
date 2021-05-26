import layout1Settings from "./Layout1/Layout1Settings";
import localStorageService from "../services/localStorageService";
import { publishNavigationChange } from "./../navigations";

const lang = localStorageService.getLang();
const role = localStorageService.getItem('userAqarz') ? localStorageService.getItem('userAqarz').role : null;
export const GullLayoutSettings = {
  activeLayout: "layout1", // layout1, layout2
  dir: lang === "en" ? "ltr" : "rtl", // ltr, rtl
  lang: lang,
  layout1Settings,
  navigationList: publishNavigationChange(role, lang),
  customizer: {
    show: false,
    open: false,
  },
  footer: {
    show: false,
  },
};

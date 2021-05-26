import { lazy } from "react";

const Layout1 = lazy(() => import("./Layout1/Layout1"));

export const GullLayouts = {
  layout1: Layout1
};

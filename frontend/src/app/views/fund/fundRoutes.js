import { lazy } from "react";
import { roles } from "./../../services/role";

const FundDashboard = lazy(() => import("./dashboard/FundDashboard"));
const FundProvidersList = lazy(() => import("./providers/fundProvidersList"));
const fundProvidersDetails = lazy(() => import("./providers/fundProvidersDetails"));

const fundRoutes = [
  {
    path: "/fund/dashboard",
    component: FundDashboard,
    auth: [roles.fund],
  },
  {
    path: "/fund/providers",
    component: FundProvidersList,
    auth: [roles.fund]
  },
  {
    path: "/fund-providers/:id",
    component: fundProvidersDetails,
    auth: [roles.fund]
  },

];

export default fundRoutes;

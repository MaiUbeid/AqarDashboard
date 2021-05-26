import { lazy } from "react";
import { roles } from "./../../services/role";

const Dashboard = lazy(() => import("./../fund/dashboard/FundDashboard"));
const usersList = lazy(() => import("./users/usersList"));
const usersDetails = lazy(() => import("./users/usersDetails"));

const adminRoutes = [
  {
    path: "/admin/dashboard",
    component: Dashboard,
    auth: [roles.admin],
  },
  {
    path: "/admin/users",
    component: usersList,
    auth: [roles.admin]
  },
  {
    path: "/user/:id",
    component: usersDetails,
    auth: [roles.admin]
  },

];

export default adminRoutes;

import { lazy } from "react";
import { roles } from "./../../services/role";

const BankDashboard = lazy(() => import("./dashboard/BankDashboard"));
const financeRequestsList = lazy(() => import("./finance-requests/financeRequestsList"));
const financeRequestsDetails = lazy(() => import("./finance-requests/financeRequestsDetails"));
const deferredInstallmentsList = lazy(() => import("./deferred-installments/deferredInstallmentsList"));
const deferredInstallmentsDetails = lazy(() => import("./deferred-installments/deferredInstallmentsDetails"));

const bankRoutes = [
  {
    path: "/bank/dashboard",
    component: BankDashboard,
    auth: [roles.bank],
  },
  {
    path: "/bank/finance-requests",
    component: financeRequestsList,
    auth: [roles.bank]
  },
  {
    path: "/finance-requests/:id",
    component: financeRequestsDetails,
    auth: [roles.bank]
  },
  {
    path: "/bank/deferred-installments",
    component: deferredInstallmentsList,
    auth: [roles.bank]
  },
  {
    path: "/deferred-installments/:id",
    component: deferredInstallmentsDetails,
    auth: [roles.bank]
  },

];

export default bankRoutes;

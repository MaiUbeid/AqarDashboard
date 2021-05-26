import React from "react";
import { Redirect } from "react-router-dom";
import { lazy } from "react";
import { roles } from "./services/role";
import sessionsRoutes from "./views/sessions/sessionsRoutes";
import AuthGuard from "./auth/AuthGuard";
import fundRoutes from "./views/fund/fundRoutes";
import bankRoutes from "./views/bank/bankRoutes";
import adminRoutes from "./views/admin/adminRoutes";

const RequestsList = lazy(() => import("./views/requests/requestsList"));
const RequestsDetails = lazy(() => import("./views/requests/requestsDetails"));
const OffersList = lazy(() => import("./views/offers/offersList"));
const OffersDetails = lazy(() => import("./views/offers/offersDetails"));
const EstateDetails = lazy(() => import("./views/estates/estateDetails"));
const EstateList = lazy(() => import("./views/estates/estateList"));

const redirectRoute = [
  {
    path: "/",
    exact: true,
    component: () => <Redirect to="/session/signin" />
  }
];

const errorRoute = [
  {
    component: () => <Redirect to="/session/404" />
  }
];

const routes = [
  ...sessionsRoutes,
  {
    path: "/",
    component: AuthGuard,
    routes: [
      {
        path: "/requests",
        component: RequestsList,
        auth: [roles.fund, roles.admin]
      },
      {
        path: "/request/:id",
        component: RequestsDetails,
        auth: [roles.fund, roles.admin]
      },
      {
        path: "/offers",
        component: OffersList,
        auth: [roles.fund, roles.admin]
      },
      {
        path: "/offer/:id",
        component: OffersDetails,
        auth: [roles.fund, roles.admin]
      },
      {
        path: "/estates",
        component: EstateList,
        auth: [roles.fund, roles.admin]
      },
      {
        path: "/estate/:id",
        component: EstateDetails,
        auth: [roles.fund, roles.admin]
      },
      ...fundRoutes,
      ...bankRoutes,
      ...adminRoutes,
      ...redirectRoute,
      ...errorRoute,
    ]
  },
];

export default routes;

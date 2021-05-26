import { roles } from "app/services/role";

let navigations = [];

export const navigationsAdminEn = [
  // {
  //   name: "الرئيسية",
  //   type: "link",
  //   path: "/admin/dashboard",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Bar-Chart",
  // },
  // {
  //   name: "الطلبات",
  //   type: "link",
  //   path: "/requests",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Building",
  // },
  // {
  //   name: "العروض المرسلة",
  //   type: "link",
  //   path: "/offers",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Medal-2",
  // },
  {
    name: "المستخدمين",
    type: "link",
    path: "/admin/users",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Address-Book",
  },
  {
    name: 'العقارات',
    type: 'link',
    path: '/estates',
    description: "Lorem ipsum",
    icon: 'i-Home-4'
  },
];

export const navigationsAdminAr = [
  // {
  //   name: "الرئيسية",
  //   type: "link",
  //   path: "/admin/dashboard",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Bar-Chart",
  // },
  // {
  //   name: "الطلبات",
  //   type: "link",
  //   path: "/requests",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Building",
  // },
  // {
  //   name: "العروض المرسلة",
  //   type: "link",
  //   path: "/offers",
  //   description: "Lorem ipsum dolor sit.",
  //   icon: "i-Medal-2",
  // },
  {
    name: 'العقارات',
    type: 'link',
    path: '/estates',
    description: "Lorem ipsum",
    icon: 'i-Home-4'
  },
  {
    name: "العقاريين",
    type: "link",
    path: "/admin/users",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Address-Book",
  },
];


export const navigationsFundEn = [
  {
    name: "الإحصائيات",
    type: "link",
    path: "/fund/dashboard",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Bar-Chart",
  },
  {
    name: "الطلبات",
    type: "dropDown",
    path: "/requests",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Building",
    sub: [
      { type: "link", path: '/requests', name: 'جميع الطلبات', value: 0 },
      { type: "link", path: '/requests?status=have_offers', name: 'طلبات استقبلت عروض', value: 0 },
      { type: "link", path: '/requests?status=have_active_offers', name: 'طلبات المعاينة', value: 0 },
      { type: "link", path: '/requests?status=dont_have_active_offers', name: 'طلبات بدون عروض', value: 0 },
      { type: "link", path: '/requests?status=complete', name: 'طلبات منفذة', value: 0 },
      { type: "link", path: '/requests?status=rejected_customer', name: 'طلبات مرفوضة', value: 0 },
    ]
  },
  {
    name: "العروض المرسلة",
    type: "link",
    path: "/offers",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Medal-2",
  },
  {
    name: "العقاريين",
    type: "dropDown",
    path: "/fund/providers",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Address-Book",
    sub: [
      { type: "link", path: '/fund/providers', name: 'جميع العقاريين', value: 0 },
      { type: "link", path: '/fund/providers?status=have_active', name: 'مفعل', value: 0 },
      // { type: "link", path: '/fund/providers?status=have_active_offers', name: 'غير مفعل' },
      // { type: "link", path: '/fund/providers?status=dont_have_active_offers', name: 'مشترك' },
      // { type: "link", path: '/fund/providers?status=complete', name: 'غير مشترك' },
      { type: "link", path: '/fund/providers?status=waite_active', name: 'في انتظار التفعيل ', value: 0 },
      { type: "link", path: '/fund/providers?status=best_providers', name: 'الأكثر نشاطاً', value: 0 },
    ]
  },
];

export const navigationsFundAr = [
  {
    name: "الإحصائيات",
    type: "link",
    path: "/fund/dashboard",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Bar-Chart",
  },
  {
    name: "الطلبات",
    type: "link",
    path: "/requests",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Building",
    sub: [
      { type: "link", path: '/requests', name: 'جميع الطلبات', value: 0 },
      { type: "link", path: '/requests?status=have_offers', name: 'طلبات استقبلت عروض', value: 0 },
      { type: "link", path: '/requests?status=have_active_offers', name: 'طلبات المعاينة', value: 0 },
      { type: "link", path: '/requests?status=dont_have_active_offers', name: 'طلبات بدون عروض', value: 0 },
      { type: "link", path: '/requests?status=complete', name: 'طلبات منفذة', value: 0 },
      { type: "link", path: '/requests?status=rejected_customer', name: 'طلبات مرفوضة', value: 0 },
    ]
  },
  {
    name: "العروض المرسلة",
    type: "link",
    path: "/offers",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Medal-2",
  },
  {
    name: "العقاريين",
    type: "link",
    path: "/fund/providers",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Address-Book",
  },
];


export const navigationsBankEn = [
  {
    name: "الإحصائيات",
    type: "link",
    path: "/bank/dashboard",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Bar-Chart",
  },
  {
    name: "التمويل",
    type: "link",
    path: "/bank/finance-requests",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Financial",
  },
  {
    name: "تقسيط التأجير ",
    type: "link",
    path: "/bank/deferred-installments",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Calendar-3",
  },
];

export const navigationsBankAr = [
  {
    name: "الإحصائيات",
    type: "link",
    path: "/bank/dashboard",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Bar-Chart",
  },
  {
    name: "التمويل",
    type: "link",
    path: "/bank/finance-requests",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Financial",
  },
  {
    name: "تقسيط التأجير ",
    type: "link",
    path: "/bank/deferred-installments",
    description: "Lorem ipsum dolor sit.",
    icon: "i-Calendar-3",
  },
];



export function publishNavigationChange(role, lang) {
  if (lang === 'ar') {
    switch (role) {
      case roles.admin:
        navigations = navigationsAdminAr;
        break;
      case roles.fund:
        navigations = navigationsFundAr;
        break;
      case roles.bank:
        navigations = navigationsBankAr;
        break;
      default:
        navigations = [];
    }
  } else {
    switch (role) {
      case roles.admin:
        navigations = navigationsAdminEn;
        break;
      case roles.fund:
        navigations = navigationsFundEn;
        break;
      case roles.bank:
        navigations = navigationsBankEn;
        break;
      default:
        navigations = [];
    }
  }
  return navigations;
};

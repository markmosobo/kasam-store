import {  createRouter, createWebHistory  } from 'vue-router';
import Index from '../views/Index.vue'
import Categories from '../views/categories/Categories.vue'
import Suppliers from '../views/suppliers/Suppliers.vue'
import ViewPurchase from '../views/purchases/Purchase.vue'
import Purchases from '../views/purchases/Purchases.vue'
import Users from '../views/users/Users.vue'
import AllProducts from '../views/products/AllProducts.vue'
import Restocked from '../views/products/Restocked.vue'
import RestockedToday from '../views/products/RestockedToday.vue'
import AddCategory from '../views/categories/AddCategory.vue'
import AddSupplier from '../views/suppliers/AddSupplier.vue'
import AddProduct from '../views/products/AddProduct.vue'
import AddPurchase from '../views/purchases/AddPurchase.vue'
import RestockProduct from '../views/products/RestockProduct.vue'
import ViewProduct from '../views/products/ViewProduct.vue'
import ViewProductHistory from '../views/products/ViewProductHistory.vue'
import EditProduct from '../views/products/EditProduct.vue'
import EditCategory from '../views/categories/EditCategory.vue'
import EditSupplier from '../views/suppliers/EditSupplier.vue'
import AddUser from '../views/users/AddUser.vue'
import EditUser from '../views/users/EditUser.vue'
import ViewUser from '../views/users/ViewUser.vue'
import ViewUserActivity from '../views/users/ViewUserActivity.vue'
import Login from '../views/Login.vue'
import Profile from '../views/Profile.vue'
import TodayPurchases from '../views/purchases/TodayPurchases.vue'
import WeekPurchases from '../views/purchases/WeekPurchases.vue'
import MonthPurchases from '../views/purchases/MonthPurchases.vue'
import YearPurchases from '../views/purchases/YearPurchases.vue'
import QuarterlyPurchases from '../views/purchases/QuarterlyPurchases.vue'
import AllPurchases from '../views/purchases/AllPurchases.vue'
import TwentyFourPurchases from '../views/purchases/TwentyFourPurchases.vue'
import YesterdayPurchases from '../views/purchases/YesterdayPurchases.vue'
import LastSevenPurchases from '../views/purchases/LastSevenPurchases.vue'
import LastThirtyPurchases from '../views/purchases/LastThirtyPurchases.vue'
import LastNinetyPurchases from '../views/purchases/LastNinetyPurchases.vue'
import LastMonthPurchases from '../views/purchases/LastMonthPurchases.vue'
import LastYearPurchases from '../views/purchases/LastYearPurchases.vue'
import TodayRevenue from '../views/purchases/TodayRevenue.vue'
import WeekRevenue from '../views/purchases/WeekRevenue.vue'
import MonthRevenue from '../views/purchases/MonthRevenue.vue'
import YearRevenue from '../views/purchases/YearRevenue.vue'
import QuarterlyRevenue from '../views/purchases/QuarterlyRevenue.vue'
import AllRevenue from '../views/purchases/AllRevenue.vue'
import TwentyFourRevenue from '../views/purchases/TwentyFourRevenue.vue'
import YesterdayRevenue from '../views/purchases/YesterdayRevenue.vue'
import LastSevenRevenue from '../views/purchases/LastSevenRevenue.vue'
import LastThirtyRevenue from '../views/purchases/LastThirtyRevenue.vue'
import LastNinetyRevenue from '../views/purchases/LastNinetyRevenue.vue'
import LastMonthRevenue from '../views/purchases/LastMonthRevenue.vue'
import LastYearRevenue from '../views/purchases/LastYearRevenue.vue'
import TodayProductHistory from '../views/products/TodayProductHistory.vue'
import TwentyFourProductHistory from '../views/products/TwentyFourProductHistory.vue'
import YesterdayProductHistory from '../views/products/YesterdayProductHistory.vue'
import LastSevenProductHistory from '../views/products/LastSevenProductHistory.vue'
import WeekProductHistory from '../views/products/WeekProductHistory.vue'
import LastThirtyProductHistory from '../views/products/LastThirtyProductHistory.vue'
import MonthProductHistory from '../views/products/MonthProductHistory.vue'
import LastMonthProductHistory from '../views/products/LastMonthProductHistory.vue'
import LastNinetyProductHistory from '../views/products/LastNinetyProductHistory.vue'
import YearProductHistory from '../views/products/YearProductHistory.vue'
import QuarterlyProductHistory from '../views/products/QuarterlyProductHistory.vue'
import LastYearProductHistory from '../views/products/LastYearProductHistory.vue'
import AllProductHistory from '../views/products/AllProductHistory.vue'

import TodayProductSale from '../views/products/TodayProductSale.vue'
import TwentyFourProductSale from '../views/products/TwentyFourProductSale.vue'
import YesterdayProductSale from '../views/products/YesterdayProductSale.vue'
import LastSevenProductSale from '../views/products/LastSevenProductSale.vue'
import WeekProductSale from '../views/products/WeekProductSale.vue'
import LastThirtyProductSale from '../views/products/LastThirtyProductSale.vue'
import MonthProductSale from '../views/products/MonthProductSale.vue'
import LastMonthProductSale from '../views/products/LastMonthProductSale.vue'
import LastNinetyProductSale from '../views/products/LastNinetyProductSale.vue'
import YearProductSale from '../views/products/YearProductSale.vue'
import QuarterlyProductSale from '../views/products/QuarterlyProductSale.vue'
import LastYearProductSale from '../views/products/LastYearProductSale.vue'
import AllProductSale from '../views/products/AllProductSale.vue'

import TodayProductRevenue from '../views/products/TodayProductRevenue.vue'
import TwentyFourProductRevenue from '../views/products/TwentyFourProductRevenue.vue'
import YesterdayProductRevenue from '../views/products/YesterdayProductRevenue.vue'
import LastSevenProductRevenue from '../views/products/LastSevenProductRevenue.vue'
import WeekProductRevenue from '../views/products/WeekProductRevenue.vue'
import LastThirtyProductRevenue from '../views/products/LastThirtyProductRevenue.vue'
import MonthProductRevenue from '../views/products/MonthProductRevenue.vue'
import LastMonthProductRevenue from '../views/products/LastMonthProductRevenue.vue'
import LastNinetyProductRevenue from '../views/products/LastNinetyProductRevenue.vue'
import YearProductRevenue from '../views/products/YearProductRevenue.vue'
import QuarterlyProductRevenue from '../views/products/QuarterlyProductRevenue.vue'
import LastYearProductRevenue from '../views/products/LastYearProductRevenue.vue'
import AllProductRevenue from '../views/products/AllProductRevenue.vue'

import MonthProductRestock from '../views/products/MonthProductRestock.vue'
import LastMonthProductRestock from '../views/products/LastMonthProductRestock.vue'
import LastNinetyProductRestock from '../views/products/LastNinetyProductRestock.vue'
import YearProductRestock from '../views/products/YearProductRestock.vue'
import QuarterlyProductRestock from '../views/products/QuarterlyProductRestock.vue'
import LastYearProductRestock from '../views/products/LastYearProductRestock.vue'
import AllProductRestock from '../views/products/AllProductRestock.vue'

import MyTodayPurchases from '../views/purchases/MyTodayPurchases.vue'
import MyTwentyFourPurchases from '../views/purchases/MyTwentyFourPurchases.vue'
import MyYesterdayPurchases from '../views/purchases/MyYesterdayPurchases.vue'
import MyLastSevenPurchases from '../views/purchases/MyLastSevenPurchases.vue'
import MyMonthPurchases from '../views/purchases/MyMonthPurchases.vue'
import MyLastMonthPurchases from '../views/purchases/MyLastMonthPurchases.vue'
import MyLastNinetyPurchases from '../views/purchases/MyLastNinetyPurchases.vue'
import MyYearPurchases from '../views/purchases/MyYearPurchases.vue'
import MyLastYearPurchases from '../views/purchases/MyLastYearPurchases.vue'
import MyQuarterlyPurchases from '../views/purchases/MyQuarterlyPurchases.vue'

import MyTodayRevenue from '../views/purchases/MyTodayRevenue.vue'
import MyTwentyFourRevenue from '../views/purchases/MyTwentyFourRevenue.vue'
import MyYesterdayRevenue from '../views/purchases/MyYesterdayRevenue.vue'
import MyLastSevenRevenue from '../views/purchases/MyLastSevenRevenue.vue'
import MyMonthRevenue from '../views/purchases/MyMonthRevenue.vue'
import MyLastMonthRevenue from '../views/purchases/MyLastMonthRevenue.vue'
import MyLastNinetyRevenue from '../views/purchases/MyLastNinetyRevenue.vue'
import MyYearRevenue from '../views/purchases/MyYearRevenue.vue'
import MyLastYearRevenue from '../views/purchases/MyLastYearRevenue.vue'
import MyQuarterlyRevenue from '../views/purchases/MyQuarterlyRevenue.vue'

//payment routes
import Checkout from '../views/payment/Checkout.vue'
import Cart from '../views/payment/Cart.vue'

import TaxTot from '../views/payment/TaxTot.vue'
import EditTaxTot from '../views/payment/EditTaxTot.vue'

import AboutInfo from '../views/payment/AboutInfo.vue'
import EditAboutInfo from '../views/payment/EditAboutInfo.vue'

function guardMyroute(to, from, next)
{
 var isAuthenticated= false;
//this is just an example. You will have to find a better or 
// centralised way to handle you localstorage data handling 
if(localStorage.getItem('user'))
  isAuthenticated = true;
 else
  isAuthenticated= false;
 if(isAuthenticated) 
 {
  next(); // allow to enter route
 } 
 else
 {
  next('/login'); // go to '/login';
 }
}

const routes = [
    {
        path:'/',
        name: 'welcome',
        component: Login
    },
    {
        path:'/dashboard',
        name: 'dashboard',
        component: Index,
        beforeEnter : guardMyroute,
    },
    {
        path:'/login',
        name: 'login',
        component: Login
    },
    {
        path:'/profile',
        name: 'profile',
        component: Profile,
        beforeEnter : guardMyroute,
    },
    {
        path:'/allproducts',
        name: 'allproducts',
        component: AllProducts,
        beforeEnter : guardMyroute,
    },
    {
        path:'/restocked',
        name: 'restocked',
        component: Restocked,
        beforeEnter : guardMyroute,
    },
    {
        path:'/restockedtoday',
        name: 'restockedtoday',
        component: RestockedToday,
        beforeEnter : guardMyroute,
    },
    {
        path:'/add-product',
        name: 'add-product',
        component: AddProduct,
        beforeEnter : guardMyroute,
    },
    {
        path:'/categories',
        name: 'categories',
        component: Categories,
        beforeEnter : guardMyroute,
    },
    {
        path:'/add-category',
        name: 'add-category',
        component: AddCategory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/add-user',
        name: 'add-user',
        component: AddUser,
        beforeEnter : guardMyroute,
    },
    {
        path:'/suppliers',
        name: 'suppliers',
        component: Suppliers,
        beforeEnter : guardMyroute,
    },
    {
        path:'/users',
        name: 'users',
        component: Users,
        beforeEnter : guardMyroute,
    },
    {
        path:'/add-supplier',
        name: 'add-supplier',
        component: AddSupplier,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchases',
        name: 'purchases',
        component: Purchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/viewpurchase/:id',
        name: 'viewpurchase',
        component: ViewPurchase,
        beforeEnter : guardMyroute,
    },    
    {
        path:'/purchaseproduct/:id',
        name: 'purchase-product',
        component: AddPurchase,
        beforeEnter : guardMyroute,
    },
    {
        path:'/restockproduct/:id',
        name: 'restock-product',
        component: RestockProduct,
        beforeEnter : guardMyroute,
    },
    {
        path:'/viewproduct/:id',
        name: 'view-product',
        component: ViewProduct,
        beforeEnter : guardMyroute,
    },
    {
        path:'/viewproducthistory/:id',
        name: 'view-producthistory',
        component: ViewProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/editproduct/:id',
        name: 'edit-product',
        component: EditProduct,
        beforeEnter : guardMyroute,
    },
    {
        path:'/editcategory/:id',
        name: 'edit-category',
        component: EditCategory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/editsupplier/:id',
        name: 'edit-supplier',
        component: EditSupplier,
        beforeEnter : guardMyroute,
    },
    {
        path:'/viewuser/:id',
        name: 'view-user',
        component: ViewUser,
        beforeEnter : guardMyroute,
    },
    {
        path:'/viewuseractivity/:id',
        name: 'view-useractivity',
        component: ViewUserActivity,
        beforeEnter : guardMyroute,
    },
    {
        path:'/edituser/:id',
        name: 'edit-user',
        component: EditUser,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasestoday',
        name: 'purchasestoday',
        component: TodayPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesweek',
        name: 'purchasesweek',
        component: WeekPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesmonth',
        name: 'purchasesmonth',
        component: MonthPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesyear',
        name: 'purchasesyear',
        component: YearPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesquarter',
        name: 'purchasesquarter',
        component: QuarterlyPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesall',
        name: 'purchasesall',
        component: AllPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasestwentyfour',
        name: 'purchasestwentyfour',
        component: TwentyFourPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchasesyesterday',
        name: 'purchasesyesterday',
        component: YesterdayPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchaseslastseven',
        name: 'purchaseslastseven',
        component: LastSevenPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchaseslastthirty',
        name: 'purchaseslastthirty',
        component: LastThirtyPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchaseslastninety',
        name: 'purchaseslastninety',
        component: LastNinetyPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchaseslastmonth',
        name: 'purchaseslastmonth',
        component: LastMonthPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/purchaseslastyear',
        name: 'purchaseslastyear',
        component: LastYearPurchases,
        beforeEnter : guardMyroute,
    },

    {
        path:'/revenuetoday',
        name: 'revenuetoday',
        component: TodayRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenueweek',
        name: 'revenueweek',
        component: WeekRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuemonth',
        name: 'revenuemonth',
        component: MonthRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenueyear',
        name: 'revenueyear',
        component: YearRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuequarter',
        name: 'revenuequarter',
        component: QuarterlyRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenueall',
        name: 'revenueall',
        component: AllRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuetwentyfour',
        name: 'revenuetwentyfour',
        component: TwentyFourRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenueyesterday',
        name: 'revenueyesterday',
        component: YesterdayRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuelastseven',
        name: 'revenuelastseven',
        component: LastSevenRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuelastthirty',
        name: 'revenuelastthirty',
        component: LastThirtyRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuelastninety',
        name: 'revenuelastninety',
        component: LastNinetyRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuelastmonth',
        name: 'revenuelastmonth',
        component: LastMonthRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/revenuelastyear',
        name: 'revenuelastyear',
        component: LastYearRevenue,
        beforeEnter : guardMyroute,
    },

    {
        path:'/producthistorytoday/:id',
        name: 'producthistorytoday',
        component: TodayProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorytwentyfour/:id',
        name: 'producthistorytwentyfour',
        component: TwentyFourProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistoryyesterday/:id',
        name: 'producthistoryyesterday',
        component: YesterdayProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorylastseven/:id',
        name: 'producthistorylastseven',
        component: LastSevenProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistoryweek/:id',
        name: 'producthistoryweek',
        component: WeekProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorylastthirty/:id',
        name: 'producthistorylastthirty',
        component: LastThirtyProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorymonth/:id',
        name: 'producthistorymonth',
        component: MonthProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorylastmonth/:id',
        name: 'producthistorylastmonth',
        component: LastMonthProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorylastninety/:id',
        name: 'producthistorylastninety',
        component: LastNinetyProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistoryyear/:id',
        name: 'producthistoryyear',
        component: YearProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistoryquarterly/:id',
        name: 'producthistoryquarterly',
        component: QuarterlyProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistorylastyear/:id',
        name: 'producthistorylastyear',
        component: LastYearProductHistory,
        beforeEnter : guardMyroute,
    },
    {
        path:'/producthistoryall/:id',
        name: 'producthistoryall',
        component: AllProductHistory,
        beforeEnter : guardMyroute,
    },

    {
        path:'/productsaletoday/:id',
        name: 'productsaletoday',
        component: TodayProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsaletwentyfour/:id',
        name: 'productsaletwentyfour',
        component: TwentyFourProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsaleyesterday/:id',
        name: 'productsaleyesterday',
        component: YesterdayProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalelastseven/:id',
        name: 'productsalelastseven',
        component: LastSevenProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsaleweek/:id',
        name: 'productsaleweek',
        component: WeekProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalelastthirty/:id',
        name: 'productsalelastthirty',
        component: LastThirtyProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalemonth/:id',
        name: 'productsalemonth',
        component: MonthProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalelastmonth/:id',
        name: 'productsalelastmonth',
        component: LastMonthProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalelastninety/:id',
        name: 'productsalelastninety',
        component: LastNinetyProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsaleyear/:id',
        name: 'productsaleyear',
        component: YearProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsalequarterly/:id',
        name: 'productsalequarterly',
        component: QuarterlyProductSale
    },
    {
        path:'/productsalelastyear/:id',
        name: 'productsalelastyear',
        component: LastYearProductSale,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productsaleall/:id',
        name: 'productsaleall',
        component: AllProductSale,
        beforeEnter : guardMyroute,
    },

    {
        path:'/productrevenuetoday/:id',
        name: 'productrevenuetoday',
        component: TodayProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuetwentyfour/:id',
        name: 'productrevenuetwentyfour',
        component: TwentyFourProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenueyesterday/:id',
        name: 'productrevenueyesterday',
        component: YesterdayProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuelastseven/:id',
        name: 'productrevenuelastseven',
        component: LastSevenProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenueweek/:id',
        name: 'productrevenueweek',
        component: WeekProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuelastthirty/:id',
        name: 'productrevenuelastthirty',
        component: LastThirtyProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuemonth/:id',
        name: 'productrevenuemonth',
        component: MonthProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuelastmonth/:id',
        name: 'productrevenuelastmonth',
        component: LastMonthProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuelastninety/:id',
        name: 'productrevenuelastninety',
        component: LastNinetyProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenueyear/:id',
        name: 'productrevenueyear',
        component: YearProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuequarterly/:id',
        name: 'productrevenuequarterly',
        component: QuarterlyProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenuelastyear/:id',
        name: 'productrevenuelastyear',
        component: LastYearProductRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrevenueall/:id',
        name: 'productrevenueall',
        component: AllProductRevenue,
        beforeEnter : guardMyroute,
    },

    {
        path:'/productrestockmonth/:id',
        name: 'productrestockmonth',
        component: MonthProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestocklastmonth/:id',
        name: 'productrestocklastmonth',
        component: LastMonthProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestocklastninety/:id',
        name: 'productrestocklastninety',
        component: LastNinetyProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestockyear/:id',
        name: 'productrestockyear',
        component: YearProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestockquarterly/:id',
        name: 'productrestockquarterly',
        component: QuarterlyProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestocklastyear/:id',
        name: 'productrestocklastyear',
        component: LastYearProductRestock,
        beforeEnter : guardMyroute,
    },
    {
        path:'/productrestockall/:id',
        name: 'productrestockall',
        component: AllProductRestock,
        beforeEnter : guardMyroute,
    },

    {
        path:'/mypurchasestoday/:id',
        name: 'mypurchasestoday',
        component: MyTodayPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchasestwentyfour/:id',
        name: 'mypurchasestwentyfour',
        component: MyTwentyFourPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchasesyesterday/:id',
        name: 'mypurchasesyesterday',
        component: MyYesterdayPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchaseslastseven/:id',
        name: 'mypurchaseslastseven',
        component: MyLastSevenPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchasesmonth/:id',
        name: 'mypurchasesmonth',
        component: MyMonthPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchaseslastmonth/:id',
        name: 'mypurchaseslastmonth',
        component: MyLastMonthPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchaseslastninety/:id',
        name: 'mypurchaseslastninety',
        component: MyLastNinetyPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchasesyear/:id',
        name: 'mypurchasesyear',
        component: MyYearPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchasesquarterly/:id',
        name: 'mypurchasesquarterly',
        component: MyQuarterlyPurchases,
        beforeEnter : guardMyroute,
    },
    {
        path:'/mypurchaseslastyear/:id',
        name: 'mypurchaseslastyear',
        component: MyLastYearPurchases,
        beforeEnter : guardMyroute,
    },

    {
        path:'/myrevenuetoday/:id',
        name: 'myrevenuetoday',
        component: MyTodayRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuetwentyfour/:id',
        name: 'myrevenuetwentyfour',
        component: MyTwentyFourRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenueyesterday/:id',
        name: 'myrevenueyesterday',
        component: MyYesterdayRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuelastseven/:id',
        name: 'myrevenuelastseven',
        component: MyLastSevenRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuemonth/:id',
        name: 'myrevenuemonth',
        component: MyMonthRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuelastmonth/:id',
        name: 'myrevenuelastmonth',
        component: MyLastMonthRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuelastninety/:id',
        name: 'myrevenuelastninety',
        component: MyLastNinetyRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenueyear/:id',
        name: 'myrevenueyear',
        component: MyYearRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuequarterly/:id',
        name: 'myrevenuequarterly',
        component: MyQuarterlyRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/myrevenuelastyear/:id',
        name: 'myrevenuelastyear',
        component: MyLastYearRevenue,
        beforeEnter : guardMyroute,
    },
    {
        path:'/checkout',
        name: 'checkout',
        component: Checkout,
        beforeEnter : guardMyroute,
    }, 
    {
        path:'/cart',
        name: 'cart',
        component: Cart,
        beforeEnter : guardMyroute,
    }, 
    {
        path:'/taxtot',
        name: 'taxtot',
        component: TaxTot,
        beforeEnter : guardMyroute,
    },
    {
        path:'/edit-taxtot/:id',
        name: 'edit-taxtot',
        component: EditTaxTot,
        beforeEnter : guardMyroute,
    },  
    {
        path:'/aboutinfo',
        name: 'aboutinfo',
        component: AboutInfo,
        beforeEnter : guardMyroute,
    },
    {
        path:'/edit-aboutinfo/:id',
        name: 'edit-aboutinfo',
        component: EditAboutInfo,
        beforeEnter : guardMyroute,
    },       
];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});

export default router;
import {  createRouter, createWebHistory  } from 'vue-router';
import Index from '../views/Index.vue'
import Categories from '../views/categories/Categories.vue'
import Suppliers from '../views/suppliers/Suppliers.vue'
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

const routes = [
    {
        path:'/',
        name: 'welcome',
        component: Login
    },
    {
        path:'/dashboard',
        name: 'dashboard',
        component: Index
    },
    {
        path:'/login',
        name: 'login',
        component: Login
    },
    {
        path:'/profile',
        name: 'profile',
        component: Profile
    },
    {
        path:'/allproducts',
        name: 'allproducts',
        component: AllProducts
    },
    {
        path:'/restocked',
        name: 'restocked',
        component: Restocked
    },
    {
        path:'/restockedtoday',
        name: 'restockedtoday',
        component: RestockedToday
    },
    {
        path:'/add-product',
        name: 'add-product',
        component: AddProduct
    },
    {
        path:'/categories',
        name: 'categories',
        component: Categories
    },
    {
        path:'/add-category',
        name: 'add-category',
        component: AddCategory
    },
    {
        path:'/add-user',
        name: 'add-user',
        component: AddUser
    },
    {
        path:'/suppliers',
        name: 'suppliers',
        component: Suppliers
    },
    {
        path:'/users',
        name: 'users',
        component: Users
    },
    {
        path:'/add-supplier',
        name: 'add-supplier',
        component: AddSupplier
    },
    {
        path:'/purchases',
        name: 'purchases',
        component: Purchases
    },
    {
        path:'/purchaseproduct/:id',
        name: 'purchase-product',
        component: AddPurchase
    },
    {
        path:'/restockproduct/:id',
        name: 'restock-product',
        component: RestockProduct
    },
    {
        path:'/viewproduct/:id',
        name: 'view-product',
        component: ViewProduct
    },
    {
        path:'/viewproducthistory/:id',
        name: 'view-producthistory',
        component: ViewProductHistory
    },
    {
        path:'/editproduct/:id',
        name: 'edit-product',
        component: EditProduct
    },
    {
        path:'/editcategory/:id',
        name: 'edit-category',
        component: EditCategory
    },
    {
        path:'/editsupplier/:id',
        name: 'edit-supplier',
        component: EditSupplier
    },
    {
        path:'/viewuser/:id',
        name: 'view-user',
        component: ViewUser
    },
    {
        path:'/viewuseractivity/:id',
        name: 'view-useractivity',
        component: ViewUserActivity
    },
    {
        path:'/edituser/:id',
        name: 'edit-user',
        component: EditUser
    },
    {
        path:'/purchasestoday',
        name: 'purchasestoday',
        component: TodayPurchases
    },
    {
        path:'/purchasesweek',
        name: 'purchasesweek',
        component: WeekPurchases
    },
    {
        path:'/purchasesmonth',
        name: 'purchasesmonth',
        component: MonthPurchases
    },
    {
        path:'/purchasesyear',
        name: 'purchasesyear',
        component: YearPurchases
    },
    {
        path:'/purchasesquarter',
        name: 'purchasesquarter',
        component: QuarterlyPurchases
    },
    {
        path:'/purchasesall',
        name: 'purchasesall',
        component: AllPurchases
    },
    {
        path:'/purchasestwentyfour',
        name: 'purchasestwentyfour',
        component: TwentyFourPurchases
    },
    {
        path:'/purchasesyesterday',
        name: 'purchasesyesterday',
        component: YesterdayPurchases
    },
    {
        path:'/purchaseslastseven',
        name: 'purchaseslastseven',
        component: LastSevenPurchases
    },
    {
        path:'/purchaseslastthirty',
        name: 'purchaseslastthirty',
        component: LastThirtyPurchases
    },
    {
        path:'/purchaseslastninety',
        name: 'purchaseslastninety',
        component: LastNinetyPurchases
    },
    {
        path:'/purchaseslastmonth',
        name: 'purchaseslastmonth',
        component: LastMonthPurchases
    },
    {
        path:'/purchaseslastyear',
        name: 'purchaseslastyear',
        component: LastYearPurchases
    },

    {
        path:'/revenuetoday',
        name: 'revenuetoday',
        component: TodayRevenue
    },
    {
        path:'/revenueweek',
        name: 'revenueweek',
        component: WeekRevenue
    },
    {
        path:'/revenuemonth',
        name: 'revenuemonth',
        component: MonthRevenue
    },
    {
        path:'/revenueyear',
        name: 'revenueyear',
        component: YearRevenue
    },
    {
        path:'/revenuequarter',
        name: 'revenuequarter',
        component: QuarterlyRevenue
    },
    {
        path:'/revenueall',
        name: 'revenueall',
        component: AllRevenue
    },
    {
        path:'/revenuetwentyfour',
        name: 'revenuetwentyfour',
        component: TwentyFourRevenue
    },
    {
        path:'/revenueyesterday',
        name: 'revenueyesterday',
        component: YesterdayRevenue
    },
    {
        path:'/revenuelastseven',
        name: 'revenuelastseven',
        component: LastSevenRevenue
    },
    {
        path:'/revenuelastthirty',
        name: 'revenuelastthirty',
        component: LastThirtyRevenue
    },
    {
        path:'/revenuelastninety',
        name: 'revenuelastninety',
        component: LastNinetyRevenue
    },
    {
        path:'/revenuelastmonth',
        name: 'revenuelastmonth',
        component: LastMonthRevenue
    },
    {
        path:'/revenuelastyear',
        name: 'revenuelastyear',
        component: LastYearRevenue
    },

    {
        path:'/producthistorytoday/:id',
        name: 'producthistorytoday',
        component: TodayProductHistory
    },
    {
        path:'/producthistorytwentyfour/:id',
        name: 'producthistorytwentyfour',
        component: TwentyFourProductHistory
    },
    {
        path:'/producthistoryyesterday/:id',
        name: 'producthistoryyesterday',
        component: YesterdayProductHistory
    },
    {
        path:'/producthistorylastseven/:id',
        name: 'producthistorylastseven',
        component: LastSevenProductHistory
    },
    {
        path:'/producthistoryweek/:id',
        name: 'producthistoryweek',
        component: WeekProductHistory
    },
    {
        path:'/producthistorylastthirty/:id',
        name: 'producthistorylastthirty',
        component: LastThirtyProductHistory
    },
    {
        path:'/producthistorymonth/:id',
        name: 'producthistorymonth',
        component: MonthProductHistory
    },
    {
        path:'/producthistorylastmonth/:id',
        name: 'producthistorylastmonth',
        component: LastMonthProductHistory
    },
    {
        path:'/producthistorylastninety/:id',
        name: 'producthistorylastninety',
        component: LastNinetyProductHistory
    },
    {
        path:'/producthistoryyear/:id',
        name: 'producthistoryyear',
        component: YearProductHistory
    },
    {
        path:'/producthistoryquarterly/:id',
        name: 'producthistoryquarterly',
        component: QuarterlyProductHistory
    },
    {
        path:'/producthistorylastyear/:id',
        name: 'producthistorylastyear',
        component: LastYearProductHistory
    },
    {
        path:'/producthistoryall/:id',
        name: 'producthistoryall',
        component: AllProductHistory
    },

    {
        path:'/productsaletoday/:id',
        name: 'productsaletoday',
        component: TodayProductSale
    },
    {
        path:'/productsaletwentyfour/:id',
        name: 'productsaletwentyfour',
        component: TwentyFourProductSale
    },
    {
        path:'/productsaleyesterday/:id',
        name: 'productsaleyesterday',
        component: YesterdayProductSale
    },
    {
        path:'/productsalelastseven/:id',
        name: 'productsalelastseven',
        component: LastSevenProductSale
    },
    {
        path:'/productsaleweek/:id',
        name: 'productsaleweek',
        component: WeekProductSale
    },
    {
        path:'/productsalelastthirty/:id',
        name: 'productsalelastthirty',
        component: LastThirtyProductSale
    },
    {
        path:'/productsalemonth/:id',
        name: 'productsalemonth',
        component: MonthProductSale
    },
    {
        path:'/productsalelastmonth/:id',
        name: 'productsalelastmonth',
        component: LastMonthProductSale
    },
    {
        path:'/productsalelastninety/:id',
        name: 'productsalelastninety',
        component: LastNinetyProductSale
    },
    {
        path:'/productsaleyear/:id',
        name: 'productsaleyear',
        component: YearProductSale
    },
    {
        path:'/productsalequarterly/:id',
        name: 'productsalequarterly',
        component: QuarterlyProductSale
    },
    {
        path:'/productsalelastyear/:id',
        name: 'productsalelastyear',
        component: LastYearProductSale
    },
    {
        path:'/productsaleall/:id',
        name: 'productsaleall',
        component: AllProductSale
    },

    {
        path:'/productrevenuetoday/:id',
        name: 'productrevenuetoday',
        component: TodayProductRevenue
    },
    {
        path:'/productrevenuetwentyfour/:id',
        name: 'productrevenuetwentyfour',
        component: TwentyFourProductRevenue
    },
    {
        path:'/productrevenueyesterday/:id',
        name: 'productrevenueyesterday',
        component: YesterdayProductRevenue
    },
    {
        path:'/productrevenuelastseven/:id',
        name: 'productrevenuelastseven',
        component: LastSevenProductRevenue
    },
    {
        path:'/productrevenueweek/:id',
        name: 'productrevenueweek',
        component: WeekProductRevenue
    },
    {
        path:'/productrevenuelastthirty/:id',
        name: 'productrevenuelastthirty',
        component: LastThirtyProductRevenue
    },
    {
        path:'/productrevenuemonth/:id',
        name: 'productrevenuemonth',
        component: MonthProductRevenue
    },
    {
        path:'/productrevenuelastmonth/:id',
        name: 'productrevenuelastmonth',
        component: LastMonthProductRevenue
    },
    {
        path:'/productrevenuelastninety/:id',
        name: 'productrevenuelastninety',
        component: LastNinetyProductRevenue
    },
    {
        path:'/productrevenueyear/:id',
        name: 'productrevenueyear',
        component: YearProductRevenue
    },
    {
        path:'/productrevenuequarterly/:id',
        name: 'productrevenuequarterly',
        component: QuarterlyProductRevenue
    },
    {
        path:'/productrevenuelastyear/:id',
        name: 'productrevenuelastyear',
        component: LastYearProductRevenue
    },
    {
        path:'/productrevenueall/:id',
        name: 'productrevenueall',
        component: AllProductRevenue
    },

    {
        path:'/productrestockmonth/:id',
        name: 'productrestockmonth',
        component: MonthProductRestock
    },
    {
        path:'/productrestocklastmonth/:id',
        name: 'productrestocklastmonth',
        component: LastMonthProductRestock
    },
    {
        path:'/productrestocklastninety/:id',
        name: 'productrestocklastninety',
        component: LastNinetyProductRestock
    },
    {
        path:'/productrestockyear/:id',
        name: 'productrestockyear',
        component: YearProductRestock
    },
    {
        path:'/productrestockquarterly/:id',
        name: 'productrestockquarterly',
        component: QuarterlyProductRestock
    },
    {
        path:'/productrestocklastyear/:id',
        name: 'productrestocklastyear',
        component: LastYearProductRestock
    },
    {
        path:'/productrestockall/:id',
        name: 'productrestockall',
        component: AllProductRestock
    },

    {
        path:'/mypurchasestoday/:id',
        name: 'mypurchasestoday',
        component: MyTodayPurchases
    },
    {
        path:'/mypurchasestwentyfour/:id',
        name: 'mypurchasestwentyfour',
        component: MyTwentyFourPurchases
    },
    {
        path:'/mypurchasesyesterday/:id',
        name: 'mypurchasesyesterday',
        component: MyYesterdayPurchases
    },
    {
        path:'/mypurchaseslastseven/:id',
        name: 'mypurchaseslastseven',
        component: MyLastSevenPurchases
    },
    {
        path:'/mypurchasesmonth/:id',
        name: 'mypurchasesmonth',
        component: MyMonthPurchases
    },
    {
        path:'/mypurchaseslastmonth/:id',
        name: 'mypurchaseslastmonth',
        component: MyLastMonthPurchases
    },
    {
        path:'/mypurchaseslastninety/:id',
        name: 'mypurchaseslastninety',
        component: MyLastNinetyPurchases
    },
    {
        path:'/mypurchasesyear/:id',
        name: 'mypurchasesyear',
        component: MyYearPurchases
    },
    {
        path:'/mypurchasesquarterly/:id',
        name: 'mypurchasesquarterly',
        component: MyQuarterlyPurchases
    },
    {
        path:'/mypurchaseslastyear/:id',
        name: 'mypurchaseslastyear',
        component: MyLastYearPurchases
    },

    {
        path:'/myrevenuetoday/:id',
        name: 'myrevenuetoday',
        component: MyTodayRevenue
    },
    {
        path:'/myrevenuetwentyfour/:id',
        name: 'myrevenuetwentyfour',
        component: MyTwentyFourRevenue
    },
    {
        path:'/myrevenueyesterday/:id',
        name: 'myrevenueyesterday',
        component: MyYesterdayRevenue
    },
    {
        path:'/myrevenuelastseven/:id',
        name: 'myrevenuelastseven',
        component: MyLastSevenRevenue
    },
    {
        path:'/myrevenuemonth/:id',
        name: 'myrevenuemonth',
        component: MyMonthRevenue
    },
    {
        path:'/myrevenuelastmonth/:id',
        name: 'myrevenuelastmonth',
        component: MyLastMonthRevenue
    },
    {
        path:'/myrevenuelastninety/:id',
        name: 'myrevenuelastninety',
        component: MyLastNinetyRevenue
    },
    {
        path:'/myrevenueyear/:id',
        name: 'myrevenueyear',
        component: MyYearRevenue
    },
    {
        path:'/myrevenuequarterly/:id',
        name: 'myrevenuequarterly',
        component: MyQuarterlyRevenue
    },
    {
        path:'/myrevenuelastyear/:id',
        name: 'myrevenuelastyear',
        component: MyLastYearRevenue
    },
];

const router = createRouter({
    history: createWebHistory('/'),
    routes
});

export default router;
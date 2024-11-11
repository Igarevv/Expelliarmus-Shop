import HomePage from "@/shop/views/Main/HomePage.vue";
import NotFound from "@/components/Default/NotFound.vue";
import SignUp from "@/shop/views/Auth/SignUp.vue";
import LogIn from "@/shop/views/Auth/LogIn.vue";
import Wishlist from "@/shop/views/Order/Wishlist.vue";
import AboutUs from "@/shop/views/Main/AboutUs.vue"
import Contact from "@/shop/views/Main/Contact.vue"
import AccountSettings from "@/shop/views/Account/AccountSettings.vue";
import Cart from "@/shop/views/Order/Cart.vue";
import CheckOut from "@/shop/views/Order/Checkout.vue";
import Product from "@/shop/views/Product/Product.vue";

export default [
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/sign-up',
        component: SignUp
    },
    {
        path: '/log-in',
        component: LogIn
    },
    {
        path: '/shop/:productSlug',
        name: 'product',
        component: Product
    },
    {
        path: '/wishlist',
        component: Wishlist
    },
    {
        path: '/cart',
        component: Cart
    },
    {
        path: '/checkout',
        component: CheckOut
    },
    {
        path: '/about-us',
        component: AboutUs
    },
    {
        path: '/contact',
        component: Contact
    },
    {
        path: '/account',
        component: AccountSettings
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];

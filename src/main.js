const app = document.getElementById('app');
import { render , router } from "@/utilities";
import about from "./pages/tickets";
import homePage from "./pages/homePage";

// import classes from './main.module.css';
// import $ from 'jquery';

router.on('/', ()=>render(homePage,app));
router.on('/about', ()=>render(about,app));
router.resolve();


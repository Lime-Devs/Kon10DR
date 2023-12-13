import React, { useState } from "react";
import { HiMenuAlt3 } from "react-icons/hi";
import navbarlogo2 from "../../images/navbarlogo2.png";


const mobileulSubMenuStyling = "flex flex-col w-full h-full items-center justify-center backdrop-blur-md backdrop-filter"
const mobiledivSubMenuStyling = "fixed left-0 top-0 w-full bg-black/90 px-4 py-7 flex-col z-20"
const navMenuStyling = "font-banger text-lg text-white hover:text-orange-500";
const navSubMenuStyling = "font-banger inline-flex items-center font-bangers text-lg text-white hover:text-orange-500 font-medium leading-5 transition duration-150 ease-in-out focus:outline-none"

function Navbar() {
    const [nav, setNav] = useState(false);
    const [playSublistVisible, setPlaySublistVisible] = useState(false);
    const [playersSublistVisible, setPlayersSublistVisible] = useState(false);
    const [moreSublistVisible, setMoreSublistVisible] = useState(false);

    const toggleState = (setter) => () => {
      if (nav) {
        setPlaySublistVisible(false);
        setPlayersSublistVisible(false);
        setMoreSublistVisible(false);
      }
      setter((prevState) => !prevState);
    };

    return (
        <div className="fixed top-0 left-0 w-full z-50">
            {/* Add the Bangers font from Google Fonts */}
            <link
              href="https://fonts.googleapis.com/css2?family=Bangers&display=swap"
              rel="stylesheet"
            />
            <div className="flex justify-between items-center p-4 h-16 bg-black/90">
                <img
                    src={navbarlogo2}
                    alt="Navbar Logo"
                    className="w-32 z-20 cursor-pointer"
                    onClick={() => {
                        window.location.href = "/";
                    }}
                />
                {/* Desktop Links */}
                <div className="hidden lg:flex space-x-4 items-center justify-center">
                    {/* PLAY dropdown */}
                    <div className="relative group">
                        <span className={`${navMenuStyling} cursor-pointer`}>
                            PLAY
                        </span>
                        <div className="absolute left-0 mt-2 min-w-64 bg-black/90 rounded-lg p-2 z-10 group-hover:block hidden">
                            <PlaySublist />
                        </div>
                    </div>
                    {/* <a className={`${navMenuStyling}`} href="/News">NEWS</a> */}
                    <a className={`${navMenuStyling}`} href="/Watch">WATCH</a>
                    {/* PLAYERS dropdown */}
                    <div className="relative group">
                        {/* <span className={`${navMenuStyling} cursor-pointer`}>
                            PLAYERS
                        </span> */}
                        <div className="absolute left-0 mt-2 min-w-64 bg-black/90 rounded-lg p-2 z-10 group-hover:block hidden">
                            <PlayersSublist />
                        </div>
                    </div>
                    {/* MORE dropdown */}
                    <div className="relative group">
                        <span
                            className={`${navMenuStyling} cursor-pointer desktop-more`}
                            onMouseOver={() => setMoreSublistVisible(true)}
                            onMouseOut={() => setMoreSublistVisible(false)}
                        >
                            MORE
                        </span>
                        <div
                            className={`absolute left-0 mt-2 min-w-full bg-black/90 rounded-lg p-2 z-10 ${
                                moreSublistVisible ? "block" : "hidden"
                            }`}
                            onMouseOver={() => setMoreSublistVisible(true)}
                            onMouseOut={() => setMoreSublistVisible(false)}
                            style={{ top: "100%" }}
                        >
                            <MoreSublist />
                        </div>
                    </div>
                    <a className={`${navMenuStyling}`} href="/login">LOG IN</a>
                    <a className="font-bangers h-14 text-white tracking-wide bg-orange-500 rounded-full flex items-center 
                      justify-center px-8 text-lg font-semibold shadow-md" href="/register">
                      SIGN UP
                    </a>
                </div>
                {/* Mobile Menu Icon */}
                <div className="block lg:hidden">
                    {!nav && (
                        <HiMenuAlt3
                            onClick={toggleState(setNav)}
                            className="z-20 text-white cursor-pointer hover:bg-orange-600 transition duration-300 ease-in-out"
                            size={35}
                        />
                    )}
                </div>
            </div>

            {/* Mobile Menu */}
            {nav && (
                <div className={`${mobiledivSubMenuStyling}`}>
                    <ul className={`${mobileulSubMenuStyling}`}>
                        <li
                            className={`${navMenuStyling} cursor-pointer`}
                            onClick={toggleState(setPlaySublistVisible)}
                        >
                            PLAY
                        </li>
                        {playSublistVisible && <PlaySublist />}

                        {/* <li>
                            <a className={`${navMenuStyling}`} href="/News">NEWS</a>
                        </li> */}

                        <li>
                            <a className={`${navMenuStyling}`} href="/Watch">WATCH</a>
                        </li>

                        {/* <li
                            className={`${navMenuStyling} cursor-pointer`}
                            onClick={toggleState(setPlayersSublistVisible)}
                        >
                            PLAYERS
                        </li> */}
                        {playersSublistVisible && <PlayersSublist />}

                        <li
                            className={`${navMenuStyling} cursor-pointer`}
                            onClick={toggleState(setMoreSublistVisible)}
                        >
                            MORE
                        </li>
                        {moreSublistVisible && <MoreSublist />}

                        <li>
                            <a className={`${navMenuStyling}`} href="/login">LOG IN</a>
                        </li>

                        <li>
                            <div class="h-16 text-white tracking-wide bg-orange-500 rounded-full flex items-center justify-center px-8 font-bangers 
                              font-sans text-lg font-semibold shadow-md">
                              <a className={`font-sans ${navMenuStyling}`} href="/register">SIGN UP</a>
                            </div>
                        </li>
                    </ul>

                    <div className="absolute top-4 right-4 z-30">
                        <HiMenuAlt3
                            onClick={toggleState(setNav)}
                            className="text-white cursor-pointer hover:bg-orange-600 transition duration-300 ease-in-out"
                            size={35}
                        />
                    </div>
                </div>
            )}
        </div>
    );
}

const PlaySublist = () => (
    <ul className={`${mobileulSubMenuStyling}`}>
        <li>
            <a className={`${navSubMenuStyling}`} href="/Games">GAMES</a>
        </li>
        <li>
            <a className={`${navSubMenuStyling}`} href="/Tournaments">TOURNAMENTS</a>
        </li>
        {/* <li>
            <a className={`${navMenuStyling}`} href="/Arenas">ARENAS</a>
        </li>
        <li>
            <a className={`${navMenuStyling}`} href="/Challenges">CHALLENGES</a>
        </li> */}
    </ul>
);

const PlayersSublist = () => (
    <ul className={`${mobileulSubMenuStyling}`}>
        {/* <li>
            <a className={`${navSubMenuStyling}`} href="/Teams">TEAMS</a>
        </li> */}
        {/* <li className="whitespace-nowrap">
            <a className={`${navSubMenuStyling}`} href="/FreeAgents">FREE AGENTS</a>
        </li> */}
    </ul>
);

const MoreSublist = () => (
    <ul className={`${mobileulSubMenuStyling}`}>
        <li className="leading-relaxed">
            <a className={`${navSubMenuStyling}`} href="/AboutUs">ABOUT US</a>
        </li>
        {/* <li className="leading-relaxed">
            <a className={`${navSubMenuStyling}`} href="/TermsOfUse">TERMS OF USE</a>
        </li> */}
        {/* <li className="leading-relaxed">
            <a className={`${navSubMenuStyling}`} href="/PrivacyPolicy">PRIVACY POLICY</a>
        </li> */}
    </ul>
);

export default Navbar;

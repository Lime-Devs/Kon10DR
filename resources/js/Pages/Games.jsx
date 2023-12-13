import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import Navbar from "@/components/Navbar";
import { FiHeart } from "react-icons/fi";
import Footer from "@/components/Footer";

const games = [
    {
        name: "Brawl Stars",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64847a763422cd6b71f43c76_7fab97f8f1b400bdfd119561035c2b1d-1.jpeg",
    },
    {
        name: "Call Of Duty: MW2",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/648476c41f5331b6fbd9cf59_cropped-300-400-1240996.jpeg",
    },
    {
        name: "Call Of Duty: Mobile",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/648474ab3422cd6b71ef83b8_e696167b-9c0e-413d-2417-08d8cfdcfbf1_300_400.jpeg",
    },
    {
        name: "FC24",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/647806ee8bc1d570b2421c08_cropped-EA-Sports-FC-logo-640x853-p-500.webp",
    },
    {
        name: "FIFA 23",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64846274ba6758954120fc2f_40d2e388-4ff0-4da8-0d4a-08da6f1b88aa_300_400.jpeg",
    },
    {
        name: "FARLIGHT 84",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64846797e6dda9d4b9ea17b1_2146039317_IGDB-272x380.jpeg",
    },
    {
        name: "GARENA FREEFIRE",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/6484796735c44b22446da8d5_Free_Fire.webp",
    },
    {
        name: "Guilty Gear: Strive",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64847b7eaa6428f1917eec8a_game-steam-guilty-gear-strive-cover-p-500.jpeg",
    },
    {
        name: "Mortal Kombat 11",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64847e2f6bff1a3a6f0838a0_cropped-300-400-983650.jpeg",
    },
    {
        name: "Player Unknown Battleground: Mobile",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/648477045324ef534b49d39d_d6c6021e-bad4-4f51-bf01-08d8c46e1444_300_400.jpeg",
    },

    {
        name: "street fighter 6",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64846681f9e4c202cb0b9a7a_edition_Ultimate.jpeg",
    },

    {
        name: "Valorant",
        src: "https://uploads-ssl.webflow.com/64733470f753275fb1ede7d8/64847eae2093324888a10551_cropped-300-400-1317015.jpeg",
    },
];

export default function Games({ auth, laravelVersion, phpVersion }) {
    const [likedGames, setLikedGames] = useState([]);

    const toggleLike = (index) => {
        if (likedGames.includes(index)) {
            setLikedGames((prev) => prev.filter((id) => id !== index));
        } else {
            setLikedGames((prev) => [...prev, index]);
        }
    };

    return (
        <div className="bg-gray-900 min-h-screen min-w-full py-16">
            <Head title="Games" />
            <Navbar />
            <div className="flex flex-col justify-center items-center py-16">
                <h1 className="text-white text-4xl mb-2">GAMES</h1>
                <h2 className="text-orange-500 text-xl mb-8">
                    List of games we currently support
                </h2>
                <div className="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {games.map((game, index) => (
                        <div
                            key={index}
                            className="rounded-lg box-content relative shadow hover:shadow-lg transform hover:scale-105 transition-transform duration-300 p-2 cursor-pointer"
                            onClick={() => toggleLike(index)}
                        >
                            <FiHeart
                                className={`absolute top-2 left-2 ${
                                    likedGames.includes(index)
                                        ? "text-red-500"
                                        : "text-gray-400"
                                } hover:text-red-500 transition duration-300`}
                                size={24}
                            />
                            <img
                                src={game.src}
                                alt={game.name}
                                className="object-contain w-full h-auto rounded-lg"
                            />
                            <div className="text-center text-white mt-2">
                                {game.name}
                            </div>
                        </div>
                    ))}
                </div>
            </div>
            <Footer />
        </div>
    );
}

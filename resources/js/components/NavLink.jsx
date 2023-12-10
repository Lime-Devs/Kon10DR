import { Link } from '@inertiajs/react';

export default function NavLink({ active = false, className = '', children, ...props }) {
    return (
        <Link
            {...props}
            className={
                'inline-flex items-center font-bangers font-sans text-2xl p-6 text-white hover:text-orange-500 font-medium leading-5 transition duration-150 ease-in-out focus:outline-none '
            }
        >
            {children}
        </Link>
    );
}

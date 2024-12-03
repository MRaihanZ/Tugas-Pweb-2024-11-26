// Filename - hooks/useDarkSide.ts

import { useState, useEffect } from "react";

// Type for the theme could be 'light' | 'dark'
type Theme = 'light' | 'dark';

export default function useDarkSide(): [Theme, React.Dispatch<React.SetStateAction<Theme>>] {
    const [theme, setTheme] = useState<Theme>(localStorage.theme as Theme || 'light');
    
    // The colorTheme is derived from the current theme and is either 'light' or 'dark'
    const colorTheme: Theme = theme === 'dark' ? 'light' : 'dark';

    // Store theme in localStorage whenever it changes
    useEffect(() => {
        const root = window.document.documentElement;

        // Ensure that the root element only has one theme class
        root.classList.remove(colorTheme);
        root.classList.add(theme);

        if (localStorage.theme === 'dark') {
            localStorage.removeItem('theme');
        } else {
            localStorage.setItem('theme', theme);
        }
    }, [theme, colorTheme]);

    return [colorTheme, setTheme];
}

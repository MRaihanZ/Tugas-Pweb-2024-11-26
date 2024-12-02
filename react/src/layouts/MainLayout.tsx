import { ReactElement } from 'react'
import DarkMode from '@/components/local/DarkMode'

interface PropsMainLayout extends React.PropsWithChildren {
    children: ReactElement
}

const MainLayout: React.FC<PropsMainLayout> = (props): JSX.Element => {
    return (
        <>
            <header className='flex justify-end pt-5 pr-5'>
                <DarkMode />
            </header>
            <main className='h-5/6 flex justify-center items-center'>
                {props.children}
            </main>
            <footer className='flex justify-center'>
                <p className='fixed bottom-9'>Made by <a href="https://github.com/MRaihanZ" className='underline'>MRZ</a></p>
                <p className='fixed bottom-3'>Part of <a href="https://github.com/BinaryNeedle" className='underline'>BinaryNeedle</a> and <a href="https://github.com/CrazyColleagues" className='underline'>CrazyColleagues</a></p>
            </footer>
        </>
    )
}

export default MainLayout
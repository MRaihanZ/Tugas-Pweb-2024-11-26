import './assets/css/App.css'
import MainLayout from './layouts/MainLayout'
import FormComponent from './components/local/FormComponent'
import { Toaster } from "@/components/ui/sonner"
import ShowComment from './components/local/ShowComment'

function App() {


    return (
        <>
            <MainLayout>
                <section className="grid h-1/2 shadow-sm md:grid-cols-2 bg-white dark:bg-[#09090B]">
                    <section className="flex flex-col items-center justify-center p-8 text-center bg-white border border-gray-200 rounded-l-lg dark:bg-[#09090B] dark:border-[#27272A]">
                        <FormComponent />
                    </section>
                    <section className="flex flex-col p-8 text-center bg-white border border-gray-200 rounded-r-lg dark:bg-[#09090B] dark:border-[#27272A]">
                        <ShowComment />
                    </section>
                </section>
            </MainLayout>
            <Toaster />
        </>
    )
}

export default App

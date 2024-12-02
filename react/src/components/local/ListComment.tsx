import { Separator } from "@/components/ui/separator"

interface PropsListComment extends React.PropsWithChildren {
    commentNumber: number,
    comment: string,
}

const ListComment: React.FC<PropsListComment> = (props): JSX.Element => {
    return (
        <>
            <section className="grid grid-cols-12 py-1 my-3 w-[29rem] text-justify bg-white border border-gray-200 rounded-lg dark:bg-[#09090B] dark:border-[#27272A]">
                <section className="justify-self-center flex flex-col justify-center ml-3">
                    <p className="m-0 text-3xl">{props.commentNumber}</p>
                </section>
                <Separator orientation="vertical" className="justify-self-center" />
                <section className="grid-start-3 col-span-10 flex flex-col py-1 mx-3 justify-center">
                    <p className="m-0">{props.comment}</p>
                </section>
            </section>
        </>
    )
}

export default ListComment
import { zodResolver } from "@hookform/resolvers/zod"
import { useForm } from "react-hook-form"
import { z } from "zod"
import { toast } from "sonner"
import { Button } from "@/components/ui/button"
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { Textarea } from "@/components/ui/textarea"

const FormSchema = z.object({
    komentar: z
        .string()
        .min(3, {
            message: "Komen harus lebih dari 3 karakter.",
        })
        .max(50, {
            message: "Komen tidak boleh lebih dari 50 karakter.",
        }),
})

function FormComponent() {
    const form = useForm<z.infer<typeof FormSchema>>({
        resolver: zodResolver(FormSchema),
    })

    function onSubmit(data: z.infer<typeof FormSchema>) {
        const date = new Date()
        toast("Komentar Telah Ditambahkan.", {
            description: date.toUTCString(),
            action: {
                label: "Undo",
                onClick: () => console.log("Undo"),
            },
        })
        console.log(data)
    }
    return (
        <>
            <Form {...form}>
                <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6 w-[30rem]">
                    <FormField
                        control={form.control}
                        name="komentar"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel className="text-3xl">Komentar</FormLabel>
                                <FormControl>
                                    <Textarea
                                        placeholder="Tell us a little bit about yourself"
                                        className="resize-none h-32"
                                        {...field}
                                    />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        )}
                    />
                    <Button type="submit" className="w-9/12">Submit</Button>
                </form>
            </Form>
        </>
    )
}

export default FormComponent
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
    comment: z
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

    const handleSubmit = async (data: z.infer<typeof FormSchema>) => {
        const date = new Date()
        console.log(data.comment);
        try {
            const response = await fetch("http://localhost:8000/api/v1/comment", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    data: {
                        comment: data.comment,
                    },
                }),
            });

            if (response.ok) {
                console.log("ok");
            } else {
                const errorData = await response.json();
                console.log(errorData.message || "Failed to post comment. Please try again.");
            }
        } catch (error) {
            console.log("An error occurred while posting your comment.");
        }
        toast("Komentar Telah Ditambahkan.", {
            description: date.toUTCString(),
            action: {
                label: "Undo",
                onClick: () => console.log("Undo"),
            },
        })
        console.log(data)
    };
    return (
        <>
            <Form {...form}>
                <form onSubmit={form.handleSubmit(handleSubmit)} className="space-y-6 w-[30rem]">
                    <FormField
                        control={form.control}
                        name="comment"
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
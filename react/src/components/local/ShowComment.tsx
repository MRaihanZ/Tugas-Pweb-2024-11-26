import { useEffect, useRef, useState, Suspense, lazy } from "react";
import { ScrollArea } from "@/components/ui/scroll-area"
import LoadingComment from "./LoadingComment";
const ListComment = lazy(() => import("./ListComment"));


function ShowComment() {
    const [showDiv, setShowDiv] = useState(false);
    const bottomRef = useRef(null);
    // Create useEffect() soo when on mount it's fetch data

    // called when need to be render
    useEffect(() => {
        const callback: IntersectionObserverCallback = (entries: IntersectionObserverEntry[]) => {
            entries.forEach((entry: IntersectionObserverEntry) => {
                if (entry.isIntersecting) {
                    setShowDiv(true);
                }
            });
        };

        const observer = new IntersectionObserver(callback, {
            root: null,
            rootMargin: "0px",
            threshold: 1.0,
        });

        if (bottomRef.current) {
            observer.observe(bottomRef.current);
        }

        return () => {
            if (bottomRef.current) {
                observer.unobserve(bottomRef.current);
            }
        };
    }, []);

    return (
        <>
            <ScrollArea className="h-[25rem] pr-4">
                <Suspense
                    fallback={<LoadingComment />}
                >
                    <ListComment commentNumber={1} comment="asdfajsdlf aldsjflajfd;lajd aldsfjlajdflkajdf alsdfjlakjfdl;kajdf alsdfjlajdflakj dflakjsdf;lajsdflkajalskdjf;lajs df kasdf lasjdf jasl djalk dsjflkajsdlj" />
                    <ListComment commentNumber={1} comment="asdfajsdlf aldsjflajfd;lajd aldsfjlajdflkajdf alsdfjlakjfdl;kajdf alsdfjlajdflakj dflakjsdf;lajsdflkajalskdjf;lajs df kasdf lasjdf jasl djalk dsjflkajsdlj" />
                    <ListComment commentNumber={1} comment="asdfajsdlf aldsjflajfd;lajd aldsfjlajdflkajdf alsdfjlakjfdl;kajdf alsdfjlajdflakj dflakjsdf;lajsdflkajalskdjf;lajs df kasdf lasjdf jasl djalk dsjflkajsdlj" />
                    <ListComment commentNumber={1} comment="asdfajsdlf aldsjflajfd;lajd aldsfjlajdflkajdf alsdfjlakjfdl;kajdf alsdfjlajdflakj dflakjsdf;lajsdflkajalskdjf;lajs df kasdf lasjdf jasl djalk dsjflkajsdlj" />
                    <ListComment commentNumber={1} comment="asdfajsdlf aldsjflajfd;lajd aldsfjlajdflkajdf alsdfjlakjfdl;kajdf alsdfjlajdflakj dflakjsdf;lajsdflkajalskdjf;lajs df kasdf lasjdf jasl djalk dsjflkajsdlj" />
                </Suspense>
            </ScrollArea>
        </>
    )
}

export default ShowComment
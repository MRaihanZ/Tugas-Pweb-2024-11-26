import { useEffect, useRef, useState, Suspense, lazy } from "react";
import { ScrollArea } from "@/components/ui/scroll-area";
import LoadingComment from "./LoadingComment";
const ListComment = lazy(() => import("./ListComment"));

function ShowComment() {
    const [comments, setComments] = useState<{ id: string; comment: string }[]>([]);
    const [loading, setLoading] = useState(false);
    const [lastId, setLastId] = useState<string | null>(null);
    const bottomRef = useRef<HTMLDivElement | null>(null);

    const fetchLastId = async () => {
        try {
            const res = await fetch("http://localhost:8000/api/v1/comment/lastid");
            const data = await res.json();
            return data.body.id;
        } catch (error) {
            console.error("Error fetching last id:", error);
            return null;
        }
    };

    const fetchComments = async (start: string, limit: number) => {
        setLoading(true);
        try {
            const res = await fetch(
                `http://localhost:8000/api/v1/comments/{${start}}/{${limit}}`
            );
            const data = await res.json();
            setComments((prevComments) => [...prevComments, ...data.body]);
            setLoading(false);
        } catch (error) {
            console.error("Error fetching comments:", error);
            setLoading(false);
        }
    };

    useEffect(() => {
        const callback: IntersectionObserverCallback = (entries: IntersectionObserverEntry[]) => {
            entries.forEach(async (entry) => {
                if (entry.isIntersecting && !loading) {
                    if (lastId === null) {
                        const initialId = await fetchLastId();
                        if (initialId) {
                            setLastId(initialId);
                            fetchComments(initialId, 5);
                            const newLastId = (parseInt(initialId) - 5).toString();
                            setLastId(newLastId);
                        }
                    } else {
                        if (Number(lastId) <= 0) {
                            return;
                        } else {
                            fetchComments(lastId, 5);
                            const newLastId = (parseInt(lastId) - 5).toString();
                            setLastId(newLastId);
                        }
                    }
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
    }, [lastId, loading]);

    return (
        <>
            <ScrollArea className="h-[25rem] pr-4">
                <Suspense fallback={<LoadingComment />}>
                    {comments.map((comment, index) => (
                        <ListComment
                            key={`${comment.id}-${index}`}
                            commentNumber={parseInt(comment.id)}
                            comment={comment.comment}
                        />
                    ))}
                </Suspense>
                {loading && <LoadingComment />}
                <div ref={bottomRef}></div>
            </ScrollArea>
        </>
    );
}

export default ShowComment;

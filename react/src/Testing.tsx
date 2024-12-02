import React, { useEffect, useRef, useState } from "react";

function Testing() {
    const [showDiv, setShowDiv] = useState(false); // State to control visibility of the div
    const bottomRef = useRef(null); // Ref for the bottom element

    useEffect(() => {
        // Callback function for Intersection Observer
        const callback = (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    setShowDiv(true); // Show div when the bottom is reached
                }
            });
        };

        // Create Intersection Observer
        const observer = new IntersectionObserver(callback, {
            root: null, // Use the viewport as the root
            rootMargin: "0px", // No margin
            threshold: 1.0, // Trigger when 100% of the target is visible
        });

        // Observe the bottom element
        if (bottomRef.current) {
            observer.observe(bottomRef.current);
        }

        // Cleanup observer on unmount
        return () => {
            if (bottomRef.current) {
                observer.unobserve(bottomRef.current);
            }
        };
    }, []);

    return (
        <div style={{ minHeight: "150vh", padding: "20px" }}>
            <h1>Scroll to the Bottom</h1>
            <p>Keep scrolling down to see the magic!</p>

            <div
                ref={bottomRef}
                style={{
                    height: "10px",
                    backgroundColor: "transparent",
                    marginTop: "140vh",
                }}
            ></div>

            {showDiv && (
                <div
                    style={{
                        padding: "20px",
                        marginTop: "20px",
                        backgroundColor: "#4CAF50",
                        color: "white",
                        textAlign: "center",
                        fontSize: "18px",
                        borderRadius: "5px",
                    }}
                >
                    You’ve reached the bottom of the page! 🎉
                </div>
            )}
        </div>
    );
}

export default Testing
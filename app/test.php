<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>The Conduit — Home</title>
</head>

<body class="text-(--electric-blue) inter-normal h-screen flex flex-col overflow-hidden select-none">

    <!-- ░░ NAVBAR ░░ -->
    <header class="shrink-0 flex items-center justify-between px-6 py-4 border-b border-(--electric-blue)">
        <!-- Logo -->
        <span class="text-lg font-medium uppercase tracking-[0.12em]">The Conduit</span>

        <!-- Right actions -->
        <div class="flex items-center gap-6">
            <button class="text-[0.65rem] font-medium uppercase tracking-[0.14em] border border-(--electric-blue) px-5 py-2 hover:bg-(--electric-blue) hover:text-white cursor-pointer">
                New Post
            </button>
            <!-- Profile avatar -->
            <div class="w-8 h-8 rounded-full border border-(--electric-blue) flex items-center justify-center text-[0.6rem] font-medium uppercase tracking-widest cursor-pointer hover:bg-(--electric-blue) hover:text-white">
                JD
            </div>
        </div>
    </header>

    <!-- ░░ BODY: LEFT | FEED | RIGHT ░░ -->
    <div class="flex flex-1 overflow-hidden">

        <!-- ── LEFT: SPACES ── -->
        <aside class="w-52 shrink-0 border-r border-(--electric-blue) flex flex-col overflow-hidden">
            <div class="px-5 py-4 border-b border-(--electric-blue) shrink-0">
                <span class="text-[0.55rem] uppercase tracking-[0.18em] opacity-40">Spaces</span>
            </div>
            <nav class="flex-1 overflow-y-auto flex flex-col">
                <!-- Space items -->
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Architecture</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Critical Theory</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Graphic Design</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Photography</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Film & Cinema</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Urban Studies</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Experimental Music</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Net Art</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Philosophy</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Typography</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Brutalism</a>
                <a href="#" class="px-5 py-3.5 text-[0.75rem] font-normal uppercase tracking-[0.1em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">Open Source</a>
            </nav>
        </aside>

        <!-- ── CENTER: FEED ── -->
        <main class="flex-1 overflow-y-auto flex flex-col">

            <!-- Feed label -->
            <div class="px-6 py-4 border-b border-(--electric-blue) shrink-0">
                <span class="text-[0.55rem] uppercase tracking-[0.18em] opacity-40">Feed</span>
            </div>

            <!-- Posts -->
            <!-- Post 01 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@anna_voss</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">14 Mar 2026 — 11:42</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    The grid is not a constraint. It is a liberation. Every system that appears rigid is in fact the precondition for any meaningful deviation from itself.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Graphic Design</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">12 replies</span>
                </div>
            </article>

            <!-- Post 02 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@m_brandt</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">14 Mar 2026 — 09:17</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    Went back to Herzog & de Meuron's Ricola warehouse last week. Photographs do it no justice — the silkscreened panels in direct light are something completely different from what you expect.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Architecture</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">7 replies</span>
                </div>
            </article>

            <!-- Post 03 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@lena.k</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">13 Mar 2026 — 22:55</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    Is there a word for the feeling of watching a film and knowing, without any prior knowledge, that it was shot on 16mm? There should be.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Film & Cinema</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">31 replies</span>
                </div>
            </article>

            <!-- Post 04 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@t_okonkwo</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">13 Mar 2026 — 18:03</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    Noise as signal. The most interesting music being made right now lives in the margin between error and intention. Alvin Lucier understood this fifty years ago and most people still haven't caught up.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Experimental Music</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">4 replies</span>
                </div>
            </article>

            <!-- Post 05 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@r_selin</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">13 Mar 2026 — 14:29</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    Every typeface is a political act. The choice between a humanist sans and a grotesque is never neutral — it encodes an entire ideology of legibility, authority, and access.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Typography</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">19 replies</span>
                </div>
            </article>

            <!-- Post 06 -->
            <article class="border-b border-(--electric-blue) px-6 py-6 hover:bg-(--electric-blue) hover:text-white group cursor-pointer">
                <div class="flex items-baseline justify-between mb-3">
                    <span class="text-[0.6rem] uppercase tracking-[0.14em] font-medium opacity-60 group-hover:opacity-60">@anna_voss</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.12em] opacity-35 group-hover:opacity-50">12 Mar 2026 — 08:11</span>
                </div>
                <p class="text-sm font-normal leading-relaxed tracking-wide">
                    Been shooting exclusively with a 28mm for three months now. Vision has changed permanently. The relationship between body, space, and frame is completely different from 50mm.
                </p>
                <div class="mt-4 flex gap-6">
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">Space: Photography</span>
                    <span class="text-[0.55rem] uppercase tracking-[0.14em] opacity-40 group-hover:opacity-60">9 replies</span>
                </div>
            </article>

        </main>

        <!-- ── RIGHT: FOLLOWING ── -->
        <aside class="w-48 shrink-0 border-l border-(--electric-blue) flex flex-col overflow-hidden">
            <div class="px-5 py-4 border-b border-(--electric-blue) shrink-0">
                <span class="text-[0.55rem] uppercase tracking-[0.18em] opacity-40">Following</span>
            </div>
            <nav class="flex-1 overflow-y-auto flex flex-col">
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@anna_voss</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@m_brandt</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@lena.k</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@t_okonkwo</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@r_selin</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@h_fischer</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@p_azoulay</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@wu_design</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@noirlab</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@j_merel</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@slow.matter</a>
                <a href="#" class="px-5 py-3.5 text-[0.7rem] font-normal tracking-[0.06em] border-b border-(--electric-blue) opacity-60 hover:opacity-100 hover:bg-(--electric-blue) hover:text-white no-underline">@dk_studio</a>
            </nav>
        </aside>

    </div>

</body>
</html>

<style>
    :root {
        --electric-blue: #0b06ff;
    }

    .inter-medium {
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 500;
        font-style: normal;
    }
    .inter-bold {
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 800;
        font-style: bold;
    }
    .inter-normal {
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }

    /* hide scrollbar but keep scroll */
    aside nav::-webkit-scrollbar,
    main::-webkit-scrollbar { display: none; }
    aside nav, main { -ms-overflow-style: none; scrollbar-width: none; }
</style>
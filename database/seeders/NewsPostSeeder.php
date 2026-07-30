<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Evolution of Modern Web Frameworks: From MVC to React Server Components',
                'slug' => 'evolution-of-modern-web-frameworks-mvc-to-rsc',
                'category' => 'Software Engineering',
                'cover_image' => 'images/news/frameworks.jpg',
                'excerpt' => 'An in-depth analysis of how web architecture has shifted from server-side monolithic giants to highly optimized hybrid and component-driven models like Next.js.',
                'read_time_minutes' => 8,
                'published_at' => Carbon::now()->subDays(3),
                'is_published' => true,
                'body' => '<p>Over the last two decades, the way we build web applications has undergone a paradigm shift. In the early 2000s, server-side Model-View-Controller (MVC) frameworks like Ruby on Rails, Django, and Laravel dominated the landscape. Today, we are in the era of hybrid, component-driven meta-frameworks like Next.js and Remix. Understanding this evolution is crucial for making informed architectural decisions in modern software engineering.</p>

<h2>The Monolithic MVC Era: Server-Side Domination</h2>

<p>In the monolithic MVC paradigm, the server handles everything. A request arrives, the router dispatches it to a controller, the controller queries the database via an Object-Relational Mapper (ORM), renders an HTML template on the fly, and sends a fully-formed HTML string back to the browser. This approach offered several key advantages:</p>

<ul>
<li><strong>Search Engine Optimization (SEO):</strong> Since the server outputs complete HTML, search engine scrapers index the content immediately.</li>
<li><strong>Simplicity:</strong> A single codebase, database connection, and routing logic made development, testing, and deployment straightforward.</li>
<li><strong>Security:</strong> Secrets, API keys, and database credentials remain strictly on the server, hidden from the client.</li>
</ul>

<p>However, as users demanded richer, more interactive desktop-like web experiences (pioneered by applications like Gmail), the traditional round-trip request cycle began to feel sluggish and inadequate.</p>

<h2>The Client-Side Revolution: Single Page Applications (SPAs)</h2>

<p>To solve the responsiveness problem, developers shifted template rendering to the client side. Single Page Application (SPA) libraries and frameworks—most notably React, Angular, and Vue—became the standard. In this setup:</p>

<ul>
<li>The server serves a minimal HTML file containing a single root element and a massive Javascript bundle.</li>
<li>The browser downloads and executes the Javascript, dynamically rendering the entire UI.</li>
<li>Subsequent page transitions happen entirely in the client via AJAX requests, preventing page reloads.</li>
</ul>

<p>While user interaction improved dramatically, the SPA model introduced new engineering challenges. The initial load time suffered because users had to download and run megabytes of Javascript before seeing any content (the "blank screen" effect). Furthermore, SEO became a nightmare, as search engine crawlers frequently failed to index dynamic Javascript-rendered applications.</p>

<h2>The Return of Server Rendering: SSR, SSG, and ISR</h2>

<p>To combine the best of both worlds—SPA interactivity and monolithic SEO—meta-frameworks arose. Concepts like Server-Side Rendering (SSR), Static Site Generation (SSG), and Incremental Static Regeneration (ISR) allowed developers to pre-render HTML on the server during build time or request time, then "hydrate" it into a fully interactive React application in the browser.</p>

<p>This hybrid model was highly successful but brought a new issue: <strong>Double Data Fetching and Hydration Overhead</strong>. The server would fetch data to render the HTML, then serialize that data into the HTML layout so the client-side bundle could fetch it again to hydrate the component tree. This resulted in redundant payloads and CPU bottlenecks on lower-end mobile devices.</p>

<h2>React Server Components (RSC): The Next Paradigm</h2>

<p>React Server Components represent the latest milestone in this evolutionary timeline. RSCs partition components into two categories:</p>

<ul>
<li><strong>Server Components:</strong> Render strictly on the server. They have direct access to database models and filesystems and send zero Javascript bundle overhead to the client.</li>
<li><strong>Client Components:</strong> Render on the client for interactivity (using state, effects, or browser APIs). They are hydrated just like traditional React components.</li>
</ul>

<p>By blending client-side interactivity with zero-bundle-size server components, modern frameworks achieve unprecedented load performance while keeping development fast and cohesive.</p>',
            ],
            [
                'title' => 'Demystifying Large Language Models: Transformer Architecture Explained',
                'slug' => 'demystifying-llms-transformer-architecture',
                'category' => 'Artificial Intelligence',
                'cover_image' => 'images/news/ai-transformers.jpg',
                'excerpt' => 'How transformers changed the AI landscape, what really happens inside generative pre-trained models, and how to harness their power in production software.',
                'read_time_minutes' => 10,
                'published_at' => Carbon::now()->subDays(7),
                'is_published' => true,
                'body' => '<p>Artificial Intelligence has experienced a massive resurgence driven by Large Language Models (LLMs) like GPT-4, Claude, and Llama. At the heart of this revolution lies a single mathematical architecture: the Transformer. Introduced in the seminal 2017 paper "Attention Is All You Need" by Vaswani et al., the transformer solved the major bottleneck of sequence-to-sequence modeling. Here is how it works under the hood.</p>

<h2>Before Transformers: Recurrent Neural Networks (RNNs)</h2>

<p>Historically, language models processed text sequentially using Recurrent Neural Networks (RNNs) or Long Short-Term Memory (LSTM) cells. To process a sentence, the model had to look at the first word, update its hidden state, look at the second word, and so on. This approach suffered from two fatal flaws:</p>

<ol>
<li><strong>Lack of Parallelization:</strong> Because computation depends on the previous word\'s state, RNNs could not take full advantage of GPU parallel processing, making training on massive datasets prohibitively slow.</li>
<li><strong>Vanishing Gradient / Forgetfulness:</strong> When processing long paragraphs, RNNs struggled to maintain relationships between words at the beginning and the end of the text.</li>
</ol>

<h2>The Core Breakthrough: Self-Attention Mechanism</h2>

<p>The Transformer discarded recurrence entirely, replacing it with the **Self-Attention** mechanism. Self-attention allows the model to process all tokens in a sequence simultaneously, while mathematically scoring the relationship between every word in the sentence.</p>

<p>For example, in the sentence: <em>"The bank of the river has a deposit of clay."</em>, the word "bank" relates to "river" and "clay". In the sentence: <em>"The bank was robbed of its cash deposit."</em>, "bank" relates to "robbed" and "cash". Self-attention dynamically recalculates representation vectors for each word depending on its surrounding context, capturing polysemy with ease.</p>

<h2>The Transformer Block Architecture</h2>

<p>A typical transformer consists of two parts: the Encoder (which processes input context) and the Decoder (which predicts the next token in the sequence). Each block contains:</p>

<ul>
<li><strong>Positional Encoding:</strong> Since all tokens are processed at once, the model needs an explicit mathematical signal indicating the order of the words.</li>
<li><strong>Multi-Head Attention:</strong> Multiple attention layers run in parallel, allowing the model to focus on different aspects of relationships (e.g., syntax vs. semantics) concurrently.</li>
<li><strong>Feed-Forward Networks (FFN):</strong> Dense linear layers that process the output of the attention mechanism for each token.</li>
<li><strong>Layer Normalization and Residual Connections:</strong> Crucial mathematical tools that keep gradients stable and prevent information loss across deep networks.</li>
</ul>

<h2>Implications for Software Engineers</h2>

<p>For software engineers, understanding the Transformer helps in optimizing model integration. By recognizing that transformers generate text token-by-token (autoregression), we can design better streaming interfaces, understand the performance benefits of KV caching, and optimize context window budgets for Retrieval-Augmented Generation (RAG).</p>',
            ],
            [
                'title' => 'Resilience Patterns in Distributed Systems: Building Fault-Tolerant Microservices',
                'slug' => 'resilience-patterns-fault-tolerant-microservices',
                'category' => 'System Design',
                'cover_image' => 'images/news/system-design.jpg',
                'excerpt' => 'Explore essential microservices architectures, from circuit breakers and rate limiters to event sourcing and CQRS patterns, for building fault-tolerant applications.',
                'read_time_minutes' => 9,
                'published_at' => Carbon::now()->subDays(15),
                'is_published' => true,
                'body' => '<p>In a monolithic architecture, a component failure usually results in a localized error. In a distributed system consisting of dozens of microservices communicating over a network, a single service failure can trigger a cascading outage that brings down the entire application. To prevent this, software architects rely on proven resilience patterns. Here is an overview of the most critical patterns to implement.</p>

<h2>1. The Circuit Breaker Pattern</h2>

<p>When an upstream service becomes slow or unresponsive, a downstream service should not repeatedly bombard it with requests, as this exacerbates the bottleneck. The Circuit Breaker pattern acts like an electrical circuit breaker:</p>

<ul>
<li><strong>Closed State:</strong> Requests pass through normally. The breaker monitors call success rates.</li>
<li><strong>Open State:</strong> If the error rate exceeds a threshold, the breaker trips. Requests immediately fail-fast, returning fallback data without contacting the failing service.</li>
<li><strong>Half-Open State:</strong> After a timeout, the breaker allows a limited number of requests through to test if the service has recovered. If successful, the circuit closes; otherwise, it opens again.</li>
</ul>

<p>Implementing libraries like Resilience4j, Polly, or built-in service mesh configurations (like Istio) makes it simple to add circuit breakers to microservices calls.</p>

<h2>2. The Bulkhead Pattern</h2>

<p>Named after the partitions in a ship\'s hull that prevent water from flooding the entire vessel if one section is breached, the Bulkhead pattern isolates system resources:</p>

<ul>
<li>Instead of using a single global thread pool for all service integrations, assign dedicated thread pools or connection pools to each upstream integration.</li>
<li>If one external service hangs, its thread pool fills up, but the rest of the application remains responsive because other pools are unaffected.</li>
</ul>

<h2>3. Retry Storms and Exponential Backoff</h2>

<p>When a network request fails due to temporary jitter, retrying immediately is a good idea. However, if thousands of clients retry a struggling database at the same time, they create a "retry storm" that keeps the database down. The solution consists of three rules:</p>

<ol>
<li><strong>Exponential Backoff:</strong> Increase the delay between retries exponentially (e.g., 1s, 2s, 4s, 8s).</li>
<li><strong>Jitter (Randomness):</strong> Add random variation to the backoff timing to prevent synchronized spikes.</li>
<li><strong>Limit Max Retries:</strong> Give up after a reasonable number of attempts (e.g., 3-5 times) to avoid resource exhaustion.</li>
</ol>

<h2>4. Event-Driven Architecture and Asynchronous Messaging</h2>

<p>The ultimate way to build resilient microservices is to decouple them in time. Instead of using synchronous REST or gRPC protocols, services communicate asynchronously using messaging queues like Apache Kafka, RabbitMQ, or Amazon SQS.</p>

<p>If the billing service is offline, the ordering service can still accept customer orders, write them to a message queue, and respond immediately. When the billing service recovers, it processes the queued messages at its own pace. This design dramatically improves overall availability.</p>',
            ],
            [
                'title' => 'How to Build a Custom Query Engine in Go: From Lexer to Execution',
                'slug' => 'build-custom-query-engine-go-lexer-execution',
                'category' => 'Software Engineering',
                'cover_image' => 'images/news/query-engine.jpg',
                'excerpt' => 'A hands-on guide to implementing a database query engine, explaining tokenization, AST generation, and execution plans from scratch.',
                'read_time_minutes' => 12,
                'published_at' => Carbon::now()->subDays(1),
                'is_published' => true,
                'body' => '<p>Writing a custom parser or query engine is a highly rewarding software engineering exercise. Whether you need a domain-specific language (DSL) for config validation or a custom search engine for binary files, building it from scratch in Go is extremely efficient. Let\'s explore the lifecycle of a query engine, starting from raw string input and ending with execution.</p>

<h2>The Pipeline</h2>
<p>A typical query engine executes queries through a series of stages:</p>
<ol>
<li><strong>Lexical Analysis (Lexing):</strong> Converts a raw string input into a slice of structured tokens.</li>
<li><strong>Parsing:</strong> Evaluates tokens using grammar rules to generate an Abstract Syntax Tree (AST).</li>
<li><strong>Semantic Analysis:</strong> Evaluates types, ensures table/fields exist, and checks for query correctness.</li>
<li><strong>Execution:</strong> Evaluates the AST nodes recursively against structured memory or file buffers.</li>
</ol>

<h2>1. Lexical Analysis</h2>
<p>The lexer breaks input text into tokens such as keywords (`SELECT`, `WHERE`), identifiers (`users`, `age`), comparison operators (`=`, `>`), and literals. In Go, we define a structure for tokens and iterate through characters using a custom loop:</p>

<pre><code>type TokenType string

const (
    TokenKeyword    TokenType = "KEYWORD"
    TokenIdentifier TokenType = "IDENTIFIER"
    TokenNumber     TokenType = "NUMBER"
    TokenOperator   TokenType = "OPERATOR"
)

type Token struct {
    Type  TokenType
    Value string
}</code></pre>

<h2>2. Parsing and AST Generation</h2>
<p>Our parser walks through the tokens and builds an Abstract Syntax Tree. Each node represents a logical operation (e.g., an expression node for comparisons). For a query like <code>age > 21</code>, the tree has an operator node (`>`) at the root, with identifiers and literals as children.</p>

<h2>3. Execution Plan</h2>
<p>Once we have a valid AST, executing the query is a simple matter of walking the tree recursively. For filter clauses, we implement an evaluator that checks row values against the expression node and returns a boolean value. This simple pipeline powers massive systems, and implementing it manually gives you unique insights into how large database servers optimize complex statements.</p>',
            ],
            [
                'title' => 'Deep Dive into PostgreSQL Indexing: B-Trees, GIN, and GiST Explained',
                'slug' => 'deep-dive-postgresql-indexing-b-tree-gin-gist',
                'category' => 'Databases',
                'cover_image' => 'images/news/postgres-indexing.jpg',
                'excerpt' => 'Learn how different Postgres indexing methods store data on disk and when to use GIN over B-Trees for optimal query speed.',
                'read_time_minutes' => 9,
                'published_at' => Carbon::now()->subDays(2),
                'is_published' => true,
                'body' => '<p>PostgreSQL is one of the most powerful relational databases in the world, largely because of its advanced index support. While almost every developer knows about standard primary key indexes, Postgres offers different index models designed for specialized datasets. Choosing the correct index can reduce search times from minutes to milliseconds. Let\'s explore B-Trees, GIN, and GiST.</p>

<h2>1. B-Tree Indexes: The Standard Workhorse</h2>
<p>By default, calling <code>CREATE INDEX</code> in Postgres creates a B-Tree index. B-Tree stands for Balanced Tree, which maintains sorted key-value pairs inside structured disk pages. They are optimized for:</p>
<ul>
<li>Equality comparisons (<code>=</code>)</li>
<li>Range queries (<code>&lt;</code>, <code>&gt;</code>, <code>BETWEEN</code>)</li>
<li>Sorting operations (<code>ORDER BY</code>)</li>
</ul>
<p>A B-Tree query executes in logarithmic time <code>O(log N)</code> because it navigates down levels of pages, making search times exceptionally fast even for billions of rows.</p>

<h2>2. GIN (Generalized Inverted Index)</h2>
<p>Unlike B-Trees, which map a single key to a single row, a GIN index is an inverted index. It maps component values to a list of rows containing them. GIN is ideal for multi-valued data structures, such as:</p>
<ul>
<li>JSONB documents (indexing subkeys and values)</li>
<li>Array columns</li>
<li>Full-text search document tokens</li>
</ul>
<p>If you search for rows where a JSONB array contains a specific tag, a standard B-Tree cannot help. A GIN index resolves the containment query instantly by looking up the tag in its inverted index structure.</p>

<h2>3. GiST (Generalized Search Tree)</h2>
<p>GiST indexes serve as highly customizable templates for non-traditional indexing, most notably geographic and geometric structures. GiST uses a hierarchy of bounding boxes. For example, in geo-queries (using PostGIS), a GiST index allows Postgres to find if points fall inside complex polygons by checking nested coordinate rectangles recursively, skipping millions of irrelevant checks.</p>',
            ],
            [
                'title' => 'Demystifying WebAssembly (Wasm): Running High-Performance C++ in the Browser',
                'slug' => 'demystifying-webassembly-high-performance-cpp-browser',
                'category' => 'Web Development',
                'cover_image' => 'images/news/webassembly.jpg',
                'excerpt' => 'Understanding the WebAssembly compilation lifecycle, memory virtualization, and how to compile C++ code to run at near-native speeds in WebGL.',
                'read_time_minutes' => 8,
                'published_at' => Carbon::now()->subDays(4),
                'is_published' => true,
                'body' => '<p>WebAssembly (Wasm) is a revolutionary binary instruction format designed to run sandboxed code inside web browsers at near-native speed. Wasm enables developers to bring C, C++, Rust, and Go codebases to the web, unlocking features like high-end 3D graphics, real-time video editing, and complex mathematical simulations in plain browsers. Here is how Wasm handles compilation and memory execution.</p>

<h2>The Compilation Lifecycle</h2>
<p>Wasm does not replace Javascript. Instead, it works alongside it. The compilation and loading process typically follows these steps:</p>
<ol>
<li><strong>Compile:</strong> C++ or Rust code is compiled into a `.wasm` binary file using toolchains like Emscripten or `wasm-pack`.</li>
<li><strong>Fetch:</strong> The browser fetches the `.wasm` file over HTTP.</li>
<li><strong>Compile & Instantiate:</strong> The browser compile-engine translates the Wasm bytecode into machine-level instructions, initializing it within a safe execution sandbox.</li>
<li><strong>Interoperability:</strong> Javascript communicates with Wasm by calling exported functions, passing memory buffers back and forth.</li>
</ol>

<h2>Memory Management in Wasm</h2>
<p>Wasm uses a linear memory model. Rather than garbage-collecting variables, Wasm operates over a single, contiguous array of raw bytes represented as a Javascript `ArrayBuffer`. The compiled C++ code manages its own heap and stack inside this isolated buffer. To transfer rich structures (like strings or objects) between Wasm and JS, developers read and write raw byte offsets directly from this shared array.</p>

<p>Because Wasm execution avoids Javascript garbage collection pauses and JIT compiler overhead, execution times are highly predictable, bringing console-quality applications (like Figma and Photoshop) straight to the web browser.</p>',
            ],
            [
                'title' => 'Building High-Throughput Pipelines with Apache Kafka and Event Sourcing',
                'slug' => 'high-throughput-pipelines-apache-kafka-event-sourcing',
                'category' => 'System Design',
                'cover_image' => 'images/news/kafka-pipelines.jpg',
                'excerpt' => 'An architectural guide to decoupling read and write pipelines using Kafka partitions, consumer groups, and the CQRS pattern.',
                'read_time_minutes' => 11,
                'published_at' => Carbon::now()->subDays(8),
                'is_published' => true,
                'body' => '<p>In modern enterprise architecture, capturing state transitions as they occur is vital for analytics and scaling out microservices. Apache Kafka serves as the backbone for event-driven pipelines, providing durable, high-throughput log streams. When combined with Event Sourcing, Kafka enables systems to rebuild state at any point in history. Let\'s explore the core patterns of Kafka scaling.</p>

<h2>Partitions: The Key to Horizontal Scalability</h2>
<p>A Kafka topic is split into multiple partitions distributed across database brokers. Partitions are the unit of scale in Kafka. Only one consumer in a consumer group can read from a single partition at a time. Therefore, to scale processing:</p>
<ul>
<li>Increase topic partition count.</li>
<li>Increase matching active instances of consumers.</li>
</ul>
<p>By hashing message keys, Kafka guarantees that messages with the same key (e.g., transactions for a specific user ID) always route to the same partition, preserving absolute sequence order for critical operations.</p>

<h2>Event Sourcing and CQRS</h2>
<p>In traditional databases, we store current state. In Event Sourcing, we store the sequence of mutations (events) that led to the current state. When database readers need optimization, Command Query Responsibility Segregation (CQRS) splits the write database (optimized for event logging) from read databases (optimized for search). Kafka feeds changes asynchronously from the write model to update the read indexes in real-time.</p>',
            ],
            [
                'title' => 'The Mechanics of Git: Understanding Objects, Reflogs, and Packfiles',
                'slug' => 'git-mechanics-objects-reflogs-packfiles',
                'category' => 'DevOps',
                'cover_image' => 'images/news/git-internals.jpg',
                'excerpt' => 'Git is not a black box. Peek inside the .git directory to examine blobs, trees, commits, and how Git compacts history on disk.',
                'read_time_minutes' => 9,
                'published_at' => Carbon::now()->subDays(10),
                'is_published' => true,
                'body' => '<p>Almost every software developer uses Git daily, but few understand what lies inside the `.git` directory. Far from magic, Git is a simple, content-addressable storage system overlaid with a history-tracking graph. Understanding the object storage model makes git debugging much easier. Let\'s inspect Git objects.</p>

<h2>The Four Git Objects</h2>
<p>All data in Git is stored inside the `.git/objects` directory, named after the SHA-1 hash of their contents. The objects consist of:</p>
<ul>
<li><strong>Blobs:</strong> Raw file data. Blobs do not store filenames or directories, only the file content itself.</li>
<li><strong>Trees:</strong> Directory nodes. A tree object lists file names, file modes, and points to the SHA-1 hashes of blobs or subtrees.</li>
<li><strong>Commits:</strong> Metadata wrapper. Points to a specific tree object, names parent commit hashes, and contains the author, date, and commit message.</li>
<li><strong>Annotated Tags:</strong> Immutable commits pointing directly to specific release commit points.</li>
</ul>

<h2>Reflogs: The Safety Net</h2>
<p>If you perform a hard reset (<code>git reset --hard HEAD~3</code>), your old commits disappear from the log. However, Git does not delete them immediately. They remain in the database as "dangling commits". Git tracks all head transitions inside the **Reflog** (located at `.git/logs`). By checking `git reflog`, you can find the SHA-1 hash of the lost commits and restore them easily.</p>

<h2>How Git Compacts History: Packfiles</h2>
<p>If you modify a massive file slightly, storing it as a new blob is highly inefficient. Git periodically groups loose files into structured **Packfiles** (`.pack`), performing delta compression. By comparing history, Git stores only the incremental changes (deltas) of files, shrinking the total storage footprint dramatically.</p>',
            ],
            [
                'title' => 'Mastering CSS Grid and Subgrid: Advanced Layout Techniques for Front-End Engineers',
                'slug' => 'mastering-css-grid-subgrid-advanced-layouts',
                'category' => 'Web Development',
                'cover_image' => 'images/news/css-grid-layout.jpg',
                'excerpt' => 'Go beyond basic flexboxes and grids. Learn to design nested structures, card alignments, and dynamic spacing with pure CSS subgrid.',
                'read_time_minutes' => 7,
                'published_at' => Carbon::now()->subDays(11),
                'is_published' => true,
                'body' => '<p>Modern responsive layouts require more than simple flexbox stacks. While CSS Grid solved complex multi-dimensional alignments, designing nested components where children align with parent grids remained extremely difficult. The introduction of CSS **Subgrid** resolved this long-standing issue. Let\'s explore how subgrid aligns grids globally.</p>

<h2>The Problem: Nested Grid Containers</h2>
<p>Consider a card grid where each card has a header, main body, and footer. If the text in one card\'s body is longer, that card grows taller. Historically, aligning the headers or footers across different cards required absolute heights, JS tracking, or complex flex hacks. Children of grid containers acted independently of the main outer layout tracks.</p>

<h2>The Solution: Subgrid</h2>
<p>CSS Subgrid allows nested child grids to hook into the grid tracks defined by their parent container. By configuring a card to use subgrid, we force its inner items to align with the main container\'s rows:</p>

<pre><code>.card-grid {
    display: grid;
    grid-template-rows: repeat(auto-fit, minmax(100px, auto));
}

.card {
    grid-row: span 3;
    display: grid;
    grid-template-rows: subgrid;
}</code></pre>

<p>With this simple rule, the header, body, and footer of all cards in a row share track heights, aligning perfectly regardless of individual text length. This unlocks layouts that are completely responsive, lightweight, and mathematically robust.</p>',
            ],
            [
                'title' => 'A Practical Guide to OAuth 2.1 and OpenID Connect (OIDC) Security Flow',
                'slug' => 'practical-guide-oauth-openid-connect-security-flow',
                'category' => 'Security',
                'cover_image' => 'images/news/oauth-oidc-security.jpg',
                'excerpt' => 'A detailed breakdown of PKCE authorization codes, refresh token rotations, and token verification steps in modern web apps.',
                'read_time_minutes' => 10,
                'published_at' => Carbon::now()->subDays(14),
                'is_published' => true,
                'body' => '<p>Securing client-server communication is vital for modern software engineering. While OAuth 2.0 has been the standard for delegation protocols, the upcoming OAuth 2.1 consolidates security best practices developed over the past decade. Let\'s explore the authorization flow, focusing on PKCE and token management.</p>

<h2>Why OAuth 2.1 Deprecates Implicit Grant</h2>
<p>The implicit grant flow returned access tokens directly in the URL redirect, leaving them exposed in browser history or referrer headers. OAuth 2.1 deprecates this flow, mandating the **Authorization Code Flow with PKCE** (Proof Key for Code Exchange) for all clients (including SPAs and mobile apps).</p>

<h2>How PKCE Prevents Interception</h2>
<p>PKCE uses cryptographically generated challenge keys to secure token exchanges:</p>
<ol>
<li><strong>Code Verifier:</strong> The client generates a random high-entropy string (verifier).</li>
<li><strong>Code Challenge:</strong> The client hashes the verifier using SHA-256 and sends this challenge to the authorization server.</li>
<li><strong>Authorization:</strong> The user logs in, and the server returns a temporary authorization code.</li>
<li><strong>Exchange:</strong> The client sends the authorization code along with the original raw verifier. The server hashes the verifier and validates it against the initial challenge. If they match, it issues access and refresh tokens.</li>
</ol>
<p>If an attacker intercepts the authorization code, they cannot exchange it for tokens because they lack the raw verifier, making intercept attacks impossible.</p>

<h2>Refresh Token Rotation</h2>
<p>To secure offline access, systems use Refresh Token Rotation. Each time a client requests a new access token, the server invalidates the old refresh token and issues a new one. If a compromised refresh token is reused, the server detects the breach and invalidates the entire token family, securing the user session immediately.</p>',
            ],
            [
                'title' => 'Understanding Garbage Collection in V8: Scavenge, Mark-Sweep, and Incremental Marking',
                'slug' => 'garbage-collection-v8-scavenge-mark-sweep',
                'category' => 'Software Engineering',
                'cover_image' => 'images/news/v8-engine.jpg',
                'excerpt' => 'How Node.js and Chrome manage memory, allocate heaps, and trigger garbage collections without blocking main execution threads.',
                'read_time_minutes' => 9,
                'published_at' => Carbon::now()->subDays(16),
                'is_published' => true,
                'body' => '<p>Chrome and Node.js are powered by Google\'s V8 Engine, which compiles and executes Javascript. Since Javascript is garbage-collected, developers do not manually manage memory allocation. However, understanding how V8 reclaims memory helps in building memory-efficient applications and avoiding memory leaks. Let\'s explore the heap architecture in V8.</p>

<h2>V8 Heap Structure</h2>
<p>V8 divides the execution heap into two primary spaces:</p>
<ul>
<li><strong>New Space (Nursery):</strong> Small (typically 1MB-8MB) and optimized for short-lived allocations (e.g., variables in local functions).</li>
<li><strong>Old Space:</strong> Large and houses objects that survived garbage collections in the New Space.</li>
</ul>

<h2>1. New Space: The Scavenger Algorithm</h2>
<p>The New Space uses the Scavenger algorithm, based on the Cheney copying collector. It divides memory into two semi-spaces: **To-Space** and **From-Space**. When allocations fill up the From-Space, V8 pauses execution, copies active objects to the To-Space, and discards garbage. The spaces then swap roles. Active objects that survive multiple rounds are "promoted" to the Old Space.</p>

<h2>2. Old Space: Mark-Sweep-Compact</h2>
<p>Because the Old Space is large, copying objects is slow. Instead, V8 uses Mark-Sweep-Compact:</p>
<ol>
<li><strong>Marking:</strong> The engine traverses object pointers starting from root variables (tri-color marking) to find active nodes.</li>
<li><strong>Sweeping:</strong> The engine clears memory addresses occupied by unreferenced objects.</li>
<li><strong>Compacting:</strong> V8 moves active memory blocks to prevent memory fragmentation.</li>
</ol>

<h2>Incremental and Concurrent Marking</h2>
<p>To avoid freezing UI renderings for long periods during Old Space cycles, V8 uses **Incremental Marking**. The engine breaks the marking phase into tiny slices, interleaved with regular Javascript execution, keeping application execution fast and responsive.</p>',
            ],
            [
                'title' => 'Optimizing React Rendering: Profiling, Code Splitting, and Server Components',
                'slug' => 'optimizing-react-rendering-profiling-code-splitting',
                'category' => 'Web Development',
                'cover_image' => 'images/news/react-optimization.jpg',
                'excerpt' => 'Step-by-step techniques to audit component renders, utilize useMemo/useCallback efficiently, and design code-splitting structures.',
                'read_time_minutes' => 9,
                'published_at' => Carbon::now()->subDays(18),
                'is_published' => true,
                'body' => '<p>React is built to render fast out-of-the-box, but complex state management and deep component trees can lead to laggy interactions. When performance issues arise, developers need profiling techniques to identify bottlenecks. Here is how to audit rendering paths and build light React bundles.</p>

<h2>1. Auditing Render Paths</h2>
<p>Use the React DevTools Profiler to record interaction lanes. Look out for:</p>
<ul>
<li><strong>Unnecessary Re-renders:</strong> Components that re-render even though their visible props did not change.</li>
<li><strong>Long Render Tasks:</strong> CPU bottlenecks caused by mapping operations or calculations in render blocks.</li>
</ul>

<h2>2. useMemo and useCallback: When to Use Them</h2>
<p>Wrapping everything in <code>useMemo</code> or <code>useCallback</code> adds memory overhead. Only apply them when:</p>
<ol>
<li>Passing arrays, objects, or functions as props to child components optimized with <code>React.memo</code>.</li>
<li>Performing expensive calculations (e.g., sorting large arrays) inside the component execution block.</li>
</ol>

<h2>3. Code Splitting with React.lazy</h2>
<p>Loading the entire codebase at once increases initial load times. Split pages or complex components (like modal dialogs or charting libraries) using dynamic imports and <code>Suspense</code>:</p>

<pre><code>const ChartComponent = React.lazy(() => import(\'./ChartComponent\'));

function Dashboard() {
    return (
        &lt;Suspense fallback={&lt;Loader /&gt;}&gt;
            &lt;ChartComponent /&gt;
        &lt;/Suspense&gt;
    );
}</code></pre>

<p>Webpack/Vite splits these components into separate JS chunks, loading them on-demand and keeping the main bundle size lightweight.</p>',
            ],
            [
                'title' => 'Docker Containerization Deep Dive: Namespaces, Cgroups, and UnionFS',
                'slug' => 'docker-containerization-deep-dive-namespaces-cgroups-unionfs',
                'category' => 'DevOps',
                'cover_image' => 'images/news/docker-containers.jpg',
                'excerpt' => 'Learn how the Linux kernel isolates processes, resources, and filesystem layers to power lightweight Docker containers.',
                'read_time_minutes' => 10,
                'published_at' => Carbon::now()->subDays(20),
                'is_published' => true,
                'body' => '<p>Docker containers revolutionized how developers build, test, and ship software. While containers feel like lightweight virtual machines, they operate differently under the hood. A VM runs a full guest operating system on top of a hypervisor. A Docker container is simply an isolated Linux process running directly on the host kernel. Let\'s explore the three kernel tools that make this possible.</p>

<h2>1. Linux Namespaces: Process Isolation</h2>
<p>Namespaces isolate process views of system resources. When a container runs, Docker assigns it specific namespaces:</p>
<ul>
<li><strong>PID Namespace:</strong> Isolates process IDs. The container\'s main entry process thinks it is PID 1, but on the host, it runs as a standard PID.</li>
<li><strong>NET Namespace:</strong> Isolates network interfaces, routing tables, and ports.</li>
<li><strong>MNT Namespace:</strong> Isolates filesystem mount points.</li>
<li><strong>UTS Namespace:</strong> Isolates hostnames and domain names.</li>
</ul>

<h2>2. Control Groups (cgroups): Resource Constraints</h2>
<p>Without limits, a single compromised container could consume all host RAM and CPU cores, bringing down the system. **Control Groups** (cgroups) manage resource allocation. Docker uses cgroups to hard-limit memory access, configure CPU shares, and rate-limit disk I/O for each container, ensuring multi-tenant stability.</p>

<h2>3. UnionFS (Union File System) and Layer Stacking</h2>
<p>Containers construct filesystems by stacking read-only layers using UnionFS (typically Overlay2). When you build an image, each instruction in the Dockerfile creates a new layer. To save space, layers are shared across containers. When a container writes a file, Docker uses **Copy-on-Write** (CoW), copying the file to the container\'s thin, writable top layer, keeping the underlying image layers completely untouched.</p>',
            ],
        ];

        foreach ($posts as $post) {
            NewsPost::create($post);
        }
    }
}

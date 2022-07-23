<div id="app">
    <div class="parent">
        <draggable-resizable @drag-end="handle($event, 'id', 'drag-end')">
            This is a test example
        </draggable-resizable>
    </div>
</div>

<script>
    const DraggableResizable = Vue3DraggableResizable.default
    const DraggableContainer = Vue3DraggableResizable.DraggableContainer
    Vue.createApp({
        components: { draggableResizable: DraggableResizable },
        data() {
            return {}
        },
        mounted() {},
        methods: {
            dragEndHandle(e, id) {
                console.log(e, id)
            },
            handle(e, id, type) {
                if (type === 'drag-end') {
                    this.dragEndHandle(e, id)
                }
            }
        }
    }).mount('#app')
</script>

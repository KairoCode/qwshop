<template>
    <div class="qwit">
        <table-view pageUrl='/Seller/orders'  :params="params" :btnConfig="btnConfigs" :options="options" :searchOption="searchOptions" :dialogParam="dialogParam">
            <template #table_topleft_hook="{dialogParams}">
                <el-button type="primary" :icon="Promotion" @click="openAddDialog(dialogParams)">订单发货</el-button>
                <el-button type="primary" :icon="Printer" @click="$message.info('暂无功能')">打印面单</el-button>
            </template>
        </table-view>
        <el-dialog custom-class="table_dialog_class" v-model="data.vis" title="订单处理">
            <div class="order_list" v-for="(v,k) in data.order" :key="k">
                <div class="order_title">
                    <span class="order_no">订单号：{{v.order_no}}</span>
                </div>
                <div class="order_goods">
                    <el-row :gutter="20" v-for="(vo,key) in v.order_goods" :key="key">
                        <el-col :span="4">
                            <el-image :style="{width:'30px',height:'30px'}" :fit="'cover'" :hide-on-click-modal="true" :src="vo.goods_image" lazy >
                                <template #error>
                                    <el-icon :color="'#888'" :size="26"><Picture /></el-icon>
                                </template>
                            </el-image>
                        </el-col>
                        <el-col :span="4">{{vo.goods_name||'-'}}</el-col>
                        <el-col :span="4">{{vo.sku_name||'-'}}</el-col>
                        <el-col :span="4">{{$t('btn.money')}}{{vo.goods_price||'-'}}</el-col>
                        <el-col :span="4">x {{vo.buy_num||'-'}}</el-col>
                        <el-col :span="4" style="color:red">{{$t('btn.money')}}{{vo.total_price||'0.00'}}</el-col>
                    </el-row>
                </div>
                <div class="delivery_input">
                    <el-form label-position="right" :label-width="'70px'">
                        <el-row :gutter="20" >
                            <el-col :span="24">
                                <el-form-item label="发货信息">{{v.receive_name}} | {{v.receive_tel}} ( {{v.receive_area}} {{v.receive_address}} )</el-form-item>
                            </el-col>
                            <el-col :span="24">
                                <el-form-item label="备注">{{v.remark||'-'}}</el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="物流公司"><q-input v-model:formData="data.order[k].delivery_code" :params="{label:'物流公司',value:'delivery_code',type:'select',labelName:'name',valueName:'code'}" :dictData="{delivery_code:data.delivery}" /></el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="快递单号"><el-input  v-model="data.order[k].delivery_no" placeholder="275811554411" /></el-form-item>
                            </el-col>
                        </el-row>
                    </el-form>
                </div>
            </div>
            <div class="dialog_btn">
                <el-button type="primary" :loading="data.loading" @click="postDelivery" :icon="Promotion" >订单发货</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
import {reactive,getCurrentInstance} from "vue"
import { Promotion,Printer,Picture  } from '@element-plus/icons'
import tableView from "@/components/common/table.vue"
import {useRoute} from "vue-router"
export default {
    components:{tableView},
    setup(props) {
        const {ctx,proxy} = getCurrentInstance()
        const route  = useRoute()
        const data = reactive({
            selected:[],
            vis:false,
            order:[],
            delivery:[],
            loading:false,
        })
        const options = reactive([
            {label:'订单图片',value:'order_image',type:'avatar'},
            {label:'订单名称',value:'order_name'},
            {label:'店铺名称',value:'store_name'},
            {label:'买家昵称',value:'buyer_name'},
            {label:'订单总额',value:'total_price'},
            {label:'订单状态',value:'order_status_cn',type:'tags'},
            {label:'创建时间',value:'created_at'},
        ]);

        // 搜索字段
        const searchOptions = reactive([
            {label:'订单号',value:'order_no',where:'likeRight'},
            {label:'订单名称',value:'order_name',where:'likeRight'},
            {label:'买家',value:'nickname',where:'whereHas|user'},
            {label:'时间',value:'created_at',type:'daterange'},
        ])

        const params = {
            isWith:'store,user,refund',
            order_status:2,
        }

        const btnConfigs = reactive({
            store:{show:false},
            destroy:{show:false},
        })


        // 表单配置 
        const addColumn = [
            {label:'订单图片',value:'order_image',type:'avatar',span:24},
            {label:'订单名称',value:'order_name'},
            {label:'店铺名称',value:'store_name'},
            {label:'买家昵称',value:'buyer_name'},
            {label:'订单总额',value:'total_price'},
            {label:'商品总额',value:'order_price'},
            {label:'优惠价格',value:'coupon_money'},
            {label:'收件人名',value:'receive_name'},
            {label:'收件人手机',value:'receive_tel'},
            {label:'地址信息',value:'receive_area'},
            {label:'详细地址',value:'receive_address'},
            {label:'快递订单号',value:'delivery_no'},
            {label:'订单状态',value:'order_status_cn'},
        ]
        const editColumn = [
            {label:'收件人名',value:'receive_name'},
            {label:'收件人手机',value:'receive_tel'},
            {label:'地址信息',value:'receive_area'},
            {label:'详细地址',value:'receive_address'},
            {label:'快递订单号',value:'delivery_no'},
        ]
        const dialogParam = reactive({
            rules:{
                name:[{required:true,message:'不能为空'}]
            },
            view:{column:addColumn},
            edit:{column:editColumn},
        })

        const loadData = async ()=>{
            delivery() // 加载物流公司
            let base64Code = window.btoa(JSON.stringify({order_id:data.selected}))
            const res = await proxy.R.get('/Seller/orders/find/all',{params:base64Code})
            if(!res.code) data.order = res
        }

        const delivery = ()=>{
            if(data.delivery.length != 0) return
            proxy.R.get('/expresses',{isAll:true}).then(res=>{
                if(!res.code) data.delivery = res
            })
        }

        const openAddDialog = async (dialogParams)=>{
            const selected = dialogParams.multipleSelection()
            if(!selected) return proxy.$message.error(proxy.$t('msg.selectErr'))
            data.selected = selected
            await loadData()
            data.order.forEach((item,key)=>{
                if(item.delivery_code == '') item.delivery_code = 'yd'
                item.status = 3
            })
            data.vis = true
        }

        const postDelivery = async ()=>{
            data.loading = true
            let sucNum = 0;
            let allNum = data.order.length
            const loading = ElementPlus.ElLoading.service({
                lock: true,
                text: proxy.$t('order.sendDelivery')+' - '+sucNum+'/'+allNum,
                background: 'rgba(0, 0, 0, 0.7)',
            })
            data.order.map(item=>{
                proxy.R.put('/Seller/orders/status/edit',item).then(()=>{
                }).finally(()=>{
                    sucNum++
                    loading.setText(proxy.$t('order.sendDelivery')+' - '+sucNum+'/'+allNum)
                    if(sucNum >= allNum){
                        loading.close()
                        data.loading = false
                        data.vis = false
                        location.reload()
                    }
                })
            })
            
        }


        return {
            Promotion,Printer,Picture,
            options,searchOptions,dialogParam,btnConfigs,params,data,
            openAddDialog,postDelivery
        }
    }
}
</script>

<style lang="scss" scoped>
.order_title{
    border-bottom: 1px solid #efefef;
    padding-bottom: 15px;
    .order_no{
        border-left: 4px solid var(--el-color-primary);
        padding-left: 10px;
    }
}
.order_goods{
    margin-top: 15px;
    line-height: 30px;
    border-bottom: 1px solid #efefef;
}
.delivery_input{
    margin-top: 15px;
    margin-bottom: 15px;
}
.dialog_btn{
    padding-top: 15px;
    border-top: 1px solid #efefef;
    text-align: center;
}
</style>
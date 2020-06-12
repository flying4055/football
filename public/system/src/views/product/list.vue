<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item> <i :class="$route.meta.icon"></i> {{ this.$route.meta.title }} </el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <div class="container">
            <div class="handle-box">
                <el-input v-model.trim="query.search" placeholder="商品名称" class="handle-input mr10" clearable></el-input>
                <el-button type="primary" icon="el-icon-search" @click="handleSearch">搜索</el-button>
                <span style="float: right;">
                    <el-button type="primary" icon="el-icon-add" @click="handleAdd">添加商品</el-button>
                </span>
            </div>
            <el-table
                :data="tableData"
                border
                class="table"
                ref="multipleTable"
                header-cell-class-name="table-header"
                @selection-change="handleSelectionChange"
            >
                <el-table-column type="selection" width="55" align="center"></el-table-column>
                <el-table-column prop="id" label="ID" width="55" align="center"></el-table-column>
                <el-table-column prop="title" label="标题"></el-table-column>
                <el-table-column prop="desc" label="简介"></el-table-column>
                <el-table-column prop="keyword" label="关键字"></el-table-column>
                <el-table-column prop="currency" label="币种"></el-table-column>
                <el-table-column prop="price" label="单价"></el-table-column>
                <el-table-column prop="amount_bag" label="金币包"></el-table-column>
                <el-table-column prop="ext_json" label="扩展字段"></el-table-column>
                <el-table-column prop="category_id" label="分类"></el-table-column>
                <el-table-column prop="image" label="图片"></el-table-column>
                <el-table-column prop="create_time" label="添加时间"></el-table-column>
                <el-table-column prop="update_time" label="修改时间"></el-table-column>
                <el-table-column label="操作" width="180" align="center">
                    <template slot-scope="scope">
                        <el-button type="text" icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button type="text" icon="el-icon-warning" class="red" @click="handleDelete(scope.$index, scope.row)"
                            >下架</el-button
                        >
                    </template>
                </el-table-column>
            </el-table>
            <div class="pagination">
                <el-pagination
                    background
                    layout="total, prev, pager, next"
                    :current-page="query.pageIndex"
                    :page-size="query.pageSize"
                    :total="pageTotal"
                    @current-change="handlePageChange"
                ></el-pagination>
            </div>
        </div>

        <!-- 编辑弹出框 -->
        <el-dialog title="编辑" :visible.sync="editVisible" width="50%">
            <el-form ref="form" :model="form" label-width="70px">
                <el-form-item label="id" style="display: none;">
                    <el-input v-model="form.id"></el-input>
                </el-form-item>
                <el-form-item label="标题">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-form-item label="简介">
                    <el-input type="textarea" v-model="form.desc"></el-input>
                </el-form-item>
                <el-form-item label="关键字">
                    <el-input v-model="form.keyword"></el-input>
                </el-form-item>
                <el-form-item label="币种">
                    <el-input v-model="form.currency"></el-input>
                </el-form-item>
                <el-form-item label="单价">
                    <el-input v-model="form.price"></el-input>
                </el-form-item>
                <el-form-item label="金币包">
                    <el-input v-model="form.amount_bag"></el-input>
                </el-form-item>
                <el-form-item label="扩展包">
                    <el-input v-model="form.ext_json"></el-input>
                </el-form-item>
                <el-form-item label="分类">
                    <el-select v-model="form.category_id" placeholder="请选择分类">
                        <el-option label="分类一" value="1"></el-option>
                        <el-option label="分类二" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="图片">
                    <el-input v-model="form.image"></el-input>
                    <el-upload
                        class="avatar-uploader"
                        action=""
                        list-type="picture-card"
                        :file-list="img_list"
                        :http-request="requestUpload()"
                        :on-change="changeUpload()"
                    >
                        <img v-if="form.image" :src="form.image" class="avatar-img" />
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="editVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveEdit">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
import { uploadImage } from '../../api/index';
import { fetchData } from '../../api/product';
export default {
    name: 'basetable',
    data() {
        return {
            host_url: process.env.NODE_ENV === 'development' ? 'http://yang.fifa.test/api/upload_image' : '/api/upload_image',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            query: {
                search: '',
                pageIndex: 1,
                pageSize: 10
            },
            tableData: [],
            multipleSelection: [],
            delList: [],
            editVisible: false,
            pageTotal: 0,
            form: {
                id: 0,
                title: '',
                desc: '',
                keyword: '',
                currency: '',
                price: '',
                amount_bag: '',
                ext_json: '',
                category_id: '',
                image: ''
            },
            idx: -1,
            id: -1,
            img_list: []
        };
    },
    created() {
        this.getData();
    },
    methods: {
        // 图片上传成功后处理方法
        changeUpload(file, fileList) {
            console.log(file);
            console.log(fileList);
        },
        // 图片上传成功后处理方法
        requestUpload(params) {
            console.log(params);
        },
        // 获取列表数据
        getData() {
            fetchData(this.query).then(res => {
                console.log(res);
                if (res.code === '200') {
                    this.tableData = res.data.list;
                    this.pageTotal = res.data.count;
                }
            });
        },
        // 触发添加按钮
        handleAdd() {
            this.editVisible = true;
            // console.log('点击添加');
        },
        // 触发搜索按钮
        handleSearch() {
            this.$set(this.query, 'pageIndex', 1);
            this.getData();
        },
        // 删除操作
        handleDelete(index, row) {
            // 二次确认删除
            this.$confirm('确定要删除吗？', '提示', {
                type: 'warning'
            })
                .then(() => {
                    this.$message.success('删除成功');
                    this.tableData.splice(index, 1);
                })
                .catch(() => {});
        },
        // 多选操作
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        delAllSelection() {
            const length = this.multipleSelection.length;
            let str = '';
            this.delList = this.delList.concat(this.multipleSelection);
            for (let i = 0; i < length; i++) {
                str += this.multipleSelection[i].name + ' ';
            }
            this.$message.error(`删除了${str}`);
            this.multipleSelection = [];
        },
        // 编辑操作
        handleEdit(index, row) {
            this.idx = index;
            this.form = row;
            this.editVisible = true;
        },
        // 保存编辑
        saveEdit() {
            this.editVisible = false;
            this.$message.success(`修改第 ${this.idx + 1} 行成功`);
            this.$set(this.tableData, this.idx, this.form);
        },
        // 分页导航
        handlePageChange(val) {
            this.$set(this.query, 'pageIndex', val);
            this.getData();
        }
    }
};
</script>

<style scoped>
.handle-box {
    margin-bottom: 20px;
}

.handle-select {
    width: 120px;
}

.handle-input {
    width: 300px;
    display: inline-block;
}
.table {
    width: 100%;
    font-size: 14px;
}
.red {
    color: #ff0000;
}
.mr10 {
    margin-right: 10px;
}
.table-td-thumb {
    display: block;
    margin: auto;
    width: 40px;
    height: 40px;
}
</style>
